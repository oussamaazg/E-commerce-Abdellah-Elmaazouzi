<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCount extends Component
{
    public $wishlistCount;
    
    protected $listeners = ['removeWishlist' => 'checkWishlistCount'];

    public function checkWishlistCount()
    {
        if (Auth::check()) {
            return $this->wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
        } else {
            return $this->wishlistCount = 0;
        }
    }

    public function render()
    {
        $this->wishlistCount = $this->checkWishlistCount();
        return view('livewire.frontend.wishlist-count', [
            'wishlistCount' => $this->wishlistCount
        ]);
    }
}
