<?php

namespace App\Http\Controllers;

use App\Models\Order;
use PDF;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderby('created_at', 'DESC')->paginate(5);
        return view('frontend.orders.index', compact('orders'));
    }

    public function show(int $orderId)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $orderId)->first();
        if ($order) {
            return view('frontend.orders.view', compact('order'));
        } else {
            return redirect()->back()->with('message', 'No Order Found');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(int $sendOrder_id)
    {
        // $order = Order::where('id', $sendOrder_id)->get();
        $order = Order::where('user_id', Auth::user()->id)->where('id',$sendOrder_id)->first();
  
        $data = [
            'title' => 'Welcome to E-Commerce',
            'date' => date('m/d/Y'),
            'order' => $order
        ]; 
            
        $pdf = PDF::loadView('orderpdf', $data)->setOptions(['defaultFont' => 'sans-serif']);
     
        return $pdf->download('Order.pdf');
    }
}
