@extends('layouts.admin')

@section('title', 'Clients Orders Details')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success mb-3">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Clients Orders Details</h3>
            </div>
            <div class="card-body">
                        <h4 class="my-4">
                            <i class="fa fa-shopping-cart text-dark px-2"></i><span>My Order Details</span>
                            <a href="{{ url('admin/orders') }}" class="btn btn-outline-danger btn-sm float-end mx-1 d-flex justify-content-center align-items-center gap-1"><span class="mdi mdi-arrow-left"></span>
                                Back</a>
                            <a href="{{ url('admin/invoice/'.$order->id.'/generate') }}" class="btn btn-outline-info btn-sm float-end mx-1 d-flex justify-content-center align-items-center gap-1">
                                <span class="mdi mdi-download"></span>
                                Download Invoice
                            </a>
                            <a href="{{ url('admin/invoice/'.$order->id) }}" target="_blank" class="btn btn-outline-warning btn-sm float-end mx-1 d-flex justify-content-center align-items-center gap-1">
                                <span class="mdi mdi-eye"></span>
                                View Invoice
                            </a>
                            <a href="{{ url('admin/invoice/'.$order->id.'/mail') }}" class="btn btn-outline-info btn-sm float-end mx-1 d-flex justify-content-center align-items-center gap-1">
                                <span class="mdi mdi-email-arrow-right"></span>
                                Send Invoice Via Mail
                            </a>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Details</h5>
                                <hr>
                                <h6>Order ID: {{ $order->id }}</h6>
                                <h6>Order Created Date: {{ $order->created_at->format('d-m-y h:i A') }}</h6>
                                <h6>Payment Mode: {{ $order->payment_mode }}</h6>
                                    <h6 class="border p-2 text-success">
                                        Order Status Message: <span
                                            class="text-uppercase">{{ $order->status_message }}</span>
                                    </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>User Details</h5>
                                <hr>
                                <h6>User ID: {{ $order->user_id }}</h6>
                                <h6>Full Name: {{ $order->fullname }}</h6>
                                <h6>Email: {{ $order->email }}</h6>
                                <h6>Phone: {{ $order->phone }}</h6>
                                <h6>Address: {{ $order->address }}</h6>
                                <h6>Pin Code: {{ $order->pincode }}</h6>
                            </div>
                            <div class="col-md-12">
                                <h5>Order Items</h5>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item ID</th>
                                                <th>Image</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalPrice = 0;
                                            @endphp
                                            @forelse ($order->orderItems as $orderItem)
                                                <tr>
                                                    <td>{{ $orderItem->id }}</td>
                                                    <td>
                                                        @if ($orderItem->product->productImages)
                                                            <img src="{{ asset($orderItem->product->productImages[0]->image) }}"
                                                                style="width: 50px; height: 50px"
                                                                alt="{{ $orderItem->product->name }}">
                                                        @else
                                                            <img src="" alt="">
                                                        @endif
                                                    </td>
                                                    <td> {{ $orderItem->product->name }}</td>
                                                    <td> ${{ $orderItem->price }}</td>
                                                    <td>{{ $orderItem->quantity }}</td>
                                                    <td class="fw-bold" width="10%">
                                                        ${{ $orderItem->quantity * $orderItem->price }}</td>
                                                </tr>
                                                @php
                                                    $totalPrice += $orderItem->quantity * $orderItem->price;
                                                @endphp
                                            @empty
                                                <tr>
                                                    <td colspan="7">No Order Item Available</td>
                                                </tr>
                                            @endforelse
                                            <tr>
                                                <td colspan="5" class="fw-bold">Total Amount:</td>
                                                <td colspan="1" class="fw-bold">${{ $totalPrice }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ url('orders/'.$order->id.'/pdf') }}" class="btn btn-success float-end text-light my-4">Download The Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
