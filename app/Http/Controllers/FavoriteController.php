<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::select('*')->withTrashed()->paginate(10);
        return view('admin.favorite.index')->with('favorites', $favorites);
    }

    public function create()
    {
        return view('admin.favorite.create');
    }

    public function addToFavorite($productId)
    {
        $favorite= Favorite::where('product_id', $productId)->first();
        if(!$favorite){
            $favorite = new Favorite;
            $favorite->user_id = 1;
            $favorite->product_id = $productId;
            $status = $favorite->save();
            return redirect()->back()->with('status', $status);
        }else{
            return redirect()->back();
        }
    }
    public function removeFromFavorite($productId)
    {
        Favorite::where('product_id', $productId)->where('user_id' , 1)->delete();
    	return redirect()->back();
    }

}
