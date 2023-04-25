<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where("id", $cartId)->where('user_id', Auth::user()->id)->first();
        if ($cartData) {
            if ($cartData->product->quantity <= $cartData->quantity) {
                if ($cartData->quantity > 0) {
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Updated Successfully..!',
                        'type' => 'success',
                        'status' => 200,
                    ]);
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only ' . $cartData->product->quantity . ' Quantity Available',
                        'type' => 'error',
                        'status' => 200,
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong..!',
                'type' => 'error',
                'status' => 404,
            ]);
        }
    }

    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where("id", $cartId)->where('user_id', Auth::user()->id)->first();
        if ($cartData) {
            if ($cartData->product->quantity > $cartData->quantity) {
                $cartData->increment('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated Successfully..!',
                    'type' => 'success',
                    'status' => 200,
                ]);
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Only ' . $cartData->product->quantity . ' Quantity Available',
                    'type' => 'error',
                    'status' => 200,
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong..!',
                'type' => 'error',
                'status' => 404,
            ]);
        }
    }

    public function removeCartItem(int $cartId)
    {
        $cartData = Cart::where('user_id', Auth::user()->id)->where('id', $cartId)->first();
        if ($cartData) {
            $cartData->delete();
            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart Item Removed Successfully',
                'type' => 'success',
                'status' => 200,
            ]);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something  Went Wrong..!',
                'type' => 'error',
                'status' => 200,
            ]);
        }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
