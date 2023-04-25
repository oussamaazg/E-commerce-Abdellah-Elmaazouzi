<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $product, $category, $quantityCount = 1;

    public function mount($product, $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category,
        ]);
    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }
    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            if ($this->product->where('id', $productId)->where('status', '1')->exists()) {
                if (Cart::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists()) {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Product Aleardy Added..!',
                        'type' => 'warning',
                        'status' => 200,
                    ]);
                } else {

                    if ($this->product->quantity > 0) {
                        if ($this->product->quantity >= $this->quantityCount) {
                            // Insert Product to Cart
                            Cart::create([
                                'user_id' => Auth::user()->id,
                                'product_id' => $productId,
                                'quantity' => $this->quantityCount,
                            ]);
                            $this->emit('CartAddedUpdated');
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Added to Cart Successfully',
                                'type' => 'success',
                                'status' => 200,
                            ]);
    
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Only '.$this->product->quantity.' Quantity Available',
                                'type' => 'error',
                                'status' => 404,
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product Out of Stock',
                            'type' => 'danger',
                            'status' => 201,
                        ]);
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product Does not exists..!',
                    'type' => 'warning',
                    'status' => 404,
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please login to add to cart..!',
                'type' => 'info',
                'status' => 401,
            ]);
        }
    }

    public function addToWishlist(int $product_id)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product_id)->exists()) {
                session()->flash('message', 'Already Added to wishlist..!');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already Added to wishlist..!',
                    'type' => 'warning',
                    'status' => 409,
                ]);
                return false;
            } else {
                Wishlist::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $product_id,
                ]);
                $this->emit('removeWishlist');
                session()->flash('message', 'Added to Wishlist Successfully..!');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Added to Wishlist Successfully..!',
                    'type' => 'success',
                    'status' => 200,
                ]);
            }
        } else {
            session()->flash('message', 'Please login to continue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please login to continue',
                'type' => 'info',
                'status' => 401,
            ]);
            return false;
        }
    }
}
