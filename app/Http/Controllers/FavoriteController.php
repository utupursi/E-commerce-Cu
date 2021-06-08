<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Localization;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        if(!Auth::user()){
            return redirect()->back();
        }
        $favorites = Auth::user()->favorites;
        $localization = Localization::where('abbreviation', app()->getLocale())->first()->id;
        return view('pages.favorites', compact('favorites', 'localization'));
    }
    public function addToFavorites($locale, $id)
    {
        $favorite = Product::findOrFail(intval($id));
        $user = Auth::user();
        if ( $user->favorites()->where('product_id', $favorite->id)->first()) {

        }else{
            $user->favorites()->create([
                'product_id' => $favorite->id
            ]);
        }
        return response()->json(array('status' => true));
    }
    public function getFavoriteCount($locale)
    {
        if (!Auth::user()) {
            abort(403); 
         }
         $count = Auth::user()->favorites()->count();
         return response()->json(array('status' => true, 'count' => $count));
    }
    public function removeFromFavorites($locale, $id)
    {
        if (!Auth::user()) {
            abort(403); 
         }
         $favorite = Favorite::findOrFail(intval($id));
         if($favorite->user_id == Auth::user()->id){
             $favorite->delete();
         }
         return redirect()->back();
    }
}
