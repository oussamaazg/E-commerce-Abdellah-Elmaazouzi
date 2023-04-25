<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceOrderMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $orders = Order::whereDate('created_at', '<=', $todayDate)->paginate(5);

        $todayDate = Carbon::now()->format('d-m-Y');
        if ($request->date || $request->status) {
            $orders = Order::when($request->date != null, function($query) use ($request) {
                return $query->whereDate('created_at', $request->date);
            }, function($query) use ($todayDate) {
                return $query->whereDate('created_at', '<=', $todayDate);
            })
            ->when($request->status != null, function($query) use ($request) {
                return $query->where('status_message', $request->status);
            })->paginate(5);
        } else {
            $orders = Order::paginate(5);
        }
        
        return view('admin.orders.index', compact('orders'));
    }
    public function show(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            return view('admin.orders.view', compact('order'));
        } else {
            return redirect('admin/orders')->with('message', 'Order Id not found..!');
        }
    }

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId); 
        return view('admin.invoice.generate-invoice', compact('order'));
    }

    public function generateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId); 
        $data = ['order' => $order];

        $todayDate = Carbon::now()->format('d-m-Y');
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        return $pdf->download('invoice-'.$orderId.'-'.$todayDate.'.pdf');
    }

    public function mailInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        try {
            Mail::to($order->email)->send(new InvoiceOrderMail($order));
            return redirect('/admin/orders/'.$orderId)->with('message', 'Invoice Mail has been sent to '.$order->email);
        } catch (\Exception $e) {
            return redirect('/admin/orders/'.$orderId)->with('message', 'Somthing Went Wrong..!');
        }
    }
}
