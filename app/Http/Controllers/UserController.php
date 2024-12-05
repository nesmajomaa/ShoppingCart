<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Favorite;
use App\Http\Controllers\Admin\CartController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function loginForm()
    {
        return view('user.authentication.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/user');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not correct.',
        ])->only('email');
    }

    public function registerForm($email = null)
    {
        return view('user.authentication.register')->with('email' , $email);
    }

    public function register(Request $request)
    {
        //validate fields
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|min:6|confirmed',
            'img' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('errors', $validator->errors());
        }

        $validated = $validator->validated();
        $token = Str::random(60);

        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->password = bcrypt($validated['password']);
        if ($validated['img'] != '') {
            $filename = time().'_'.rand(1,10000).'.'.$request->img->extension();
            $validated['img']->move(public_path('user_images'), $filename);
            $user->img =  'user_images/' . $filename;
        }
        $user->remember_token = $token;
        $user->save();
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended('/user'); 
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->intended('/'); 
    }

    protected $userId = 1; // Replace with the specific user ID

    public function users()
    {
        $users = User::select('*')->withTrashed()->paginate(10);
        return view('admin.users')->with('users', $users);
    }
    
    public function index()
    {
        $products = Product::select('*')->paginate(10);
        $categories = Category::select('*')->paginate(10);
        $lastCategory = Category::latest()->first();
        $topSellingProducts = Product::orderBy('sales', 'desc')->take(10)->get();
        return view('user.index')->with(['products' => $products, 'categories' => $categories, 'lastCategory' => $lastCategory, 'topSellingProducts' => $topSellingProducts]);
    }

    public function userIndex()
    {
        $user = User::find(1);

        $products = Product::select('*')->paginate(10);
        $categories = Category::select('*')->paginate(10);

        $cartItems = Cart::with('cartProduct')->where('user_id' , 1)->get();

        $totalPrice = $cartItems->sum('total_price');
        $lastCategory = Category::latest()->first();
        $topSellingProducts = Product::orderBy('sales', 'desc')->take(10)->get();

        $favorites = $user->favorites()->with('favoriteProduct')->get();

        return view('user.userIndex')->with(['products' => $products, 'categories' => $categories, 'cartItems' => $cartItems, 'lastCategory' => $lastCategory, 'topSellingProducts' => $topSellingProducts, 'totalPrice' => $totalPrice, 'favorites' => $favorites]);
    }

    public function create()
    {
        return view('admin.favorite.create');
    }

    public function store(Request $request)
    {
        $favorite = new User;
    	$favorite->user_id = $request->user_id;
        $favorite->product_id = $request->product_id;
        $favorite->status = $request->status;
	    $status = $favorite->save();
    	return redirect()->back()->with('status', $status);
    }
}
