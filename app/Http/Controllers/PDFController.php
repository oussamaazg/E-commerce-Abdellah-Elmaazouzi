<?php
  
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use PDF;
  
class PDFController extends Controller
{
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