<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function addToFavorite($productId)
    {
        $favorite= Favorite::where('product_id', $productId)->first();
        if(!$favorite){
            $favorite = new Favorite;
            $favorite->user_id = Auth::guard('user')->user()->id;
            $favorite->product_id = $productId;
            $status = $favorite->save();
            return redirect()->back()->with('status', $status);
        }else{
            return redirect()->back();
        }
    }
    public function removeFromFavorite($productId)
    {
        Favorite::where('product_id', $productId)->where('user_id' , Auth::guard('user')->user()->id)->delete();
    	return redirect()->back();
    }

}
