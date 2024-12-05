<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function loginForm()
    {
        return view('admin.authentication.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not correct.',
        ])->only('email');
    }

    public function registerForm()
    {
        return view('admin.authentication.register');
    }

    public function register(Request $request)
    {
        //validate fields
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('errors', $validator->errors());
        }

        $validated = $validator->validated();
        $token = Str::random(60);
        $admin = new Admin;
        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->password = bcrypt($validated['password']);
        $admin->remember_token = $token;
        $admin->save();
        Auth::login($admin);
        $request->session()->regenerate();
        return redirect()->intended('/admin'); 
    }



    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->intended('/admin/login'); 
    }
}
