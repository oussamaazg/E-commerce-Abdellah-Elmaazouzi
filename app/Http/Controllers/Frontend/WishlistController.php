<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    public function index()
    {
        return view('frontend.wishlist.index');
    }
}
