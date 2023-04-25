<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistShow extends Component
{
    public function render()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();

        return view('livewire.frontend.wishlist-show', [
            'wishlist' => $wishlist
        ]);
    }

    public function removeWishlistItem(int $wishlistId)
    {
        Wishlist::where('user_id', auth()->user()->id)->where('id', $wishlistId)->delete();
        $this->emit('removeWishlist');
        session('message', 'Wishlist Item Removed Successfully..!');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Wishlist Item Removed Successfully..!',
            'type' => 'success',
            'status' => 200,
        ]);
        return ;
    }
}
