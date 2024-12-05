<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::select('*')->withTrashed()->paginate(10);
        return view('admin.categories')->with('categories', $categories);
    }

    public function categories()
    {
        $categories = Category::with('products')->select('*')->withTrashed()->paginate(10);
        return view('admin.categories')->with('categories', $categories);
    }

    public function create()
    {
        return view('admin.createCategory');
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category;
		$filename = time().'_'.rand(1,10000).'.'.$request->img->extension();
		$request->img->move(public_path('category_images'), $filename);
		$category->img = 'category_images/' . $filename;
    	$category->name = $request->name;
        $category->description = $request->description;
	    $status = $category->save();
    	return redirect()->back()->with('status', $status);
    }

    public function edit($id)
    {
        $category = Category::select('*')->where('id', $id)->first();
        return view('admin.editCategory')->with('category', $category);
    }

    public function update(CategoryRequest $request)
    {
        $category = Category::find($request->id);
		unlink(public_path( $category->img));
		$filename = time().'_'.rand(1,10000).'.'.$request->img->extension();
		$request->img->move(public_path('category_images'), $filename);
		$category->img = 'category_images/' . $filename;
        $category->name = $request->name;
        $category->description = $request->description;
    	$status = $category->save();
		return redirect()->back()->with('status', $status);
    }

    public function destroy($id)
    {
        Category::where('id', $id)->delete();
    	return redirect()->back();
    }

    public function restore($id)
    {
        Category::onlyTrashed()->where('id', $id)->restore();
    	return redirect()->back();
    }
}
