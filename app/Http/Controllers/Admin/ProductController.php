<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::with('productCategory')->select('*')->withTrashed()->paginate(10);
        return view('admin.index')->with('products', $products);
    }

    public function products()
    {
        $products = Product::with('productCategory')->select('*')->withTrashed()->paginate(10);
        return view('admin.products')->with('products', $products);
    }

    public function create()
    {
        $categories = Category::select('*')->get();
        return view('admin.createProduct')->with(['categories' => $categories]);
    }
    public function store(ProductRequest $request)
    {
        $product = new Product;
		$filename = time().'_'.rand(1,10000).'.'.$request->img->extension();
		$request->img->move(public_path('product_images'), $filename);
		$product->img = 'product_images/' . $filename;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->sales = 0;
	    $status = $product->save();
    	return redirect()->back()->with('status', $status);
    }
    /* public function productDetails($id)
    {
        $product = Product::select('*')->withTrashed()->where('id', $id)->first();
        return view('admin.products.details')->with('product' , $product); 
    } */
    public function edit($id)
    {
        $product = Product::select('*')->where('id', $id)->first();
        $categories = Category::select('*')->get();
        return view('admin.editProduct')->with(['product' => $product,'categories' => $categories]);
    }

    public function update(ProductRequest $request)
    {
        $product = Product::find($request->id);
        unlink(public_path($product->img));
        $filename = time().'_'.rand(1,10000).'.'.$request->img->extension();
		$request->img->move(public_path('product_images'), $filename);
		$product->img = 'product_images/' . $filename;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
    	$status = $product->save();
		return redirect()->back()->with('status', $status);
    }
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
    	return redirect()->back();
    }

    public function restore($id)
    {
        Product::onlyTrashed()->where('id', $id)->restore();
    	return redirect()->back();
    }
}
