<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Mail\PlaceOrderMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;
    public $fullname, $email, $phone, $pincode, $address, $payment_mode = NULL, $payment_id = NULL;

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'pincode' => 'required|string|max:6|min:6',
            'address' => 'required|string|max:500',
        ];
    }
    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id
        ]);
        foreach ($this->carts as $cartItem) {
            $ordersItems = Orderitem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price
            ]);
            $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
        }
        return $order;
    }

    public function sendOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $sendOrder = $this->placeOrder();
        if ($sendOrder) {
            Cart::where('user_id', Auth::user()->id)->delete();

            try {
                $order = Order::findOrFail($sendOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMail($order));
                // Mail send successfully
            } catch (\Throwable $th) {
                
            }

            session()->flash('message', 'Order Placed Succesfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed Succesfully',
                'type' => 'success',
                'status' => 200,
            ]);
            return redirect()->to('orders/'.$sendOrder->id);
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong',
                'type' => 'error',
                'status' => 401,
            ]);
        }
    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }
    public function render()
    {
        $this->fullname = Auth::user()->name;
        $this->email = Auth::user()->email;
        // $this->phone = (Auth::user()->userDetail->phone) ? Auth::user()->userDetail->phone : "" ;
        // $this->pincode = (Auth::user()->userDetail->pincode) ? Auth::user()->userDetail->pincode : "" ;
        // $this->address = (Auth::user()->userDetail->address) ? Auth::user()->userDetail->address : "" ;


        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount 
        ]);
    }
}
