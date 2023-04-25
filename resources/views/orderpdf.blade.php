<div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2></h2>
                <h4>Thank you for Shopping</h4>
            </div>
        </div>
        <div class="row">
            <h1>{{ $title }}</h1>
            <p>{{ $date }}</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4>
                        <i class="fa fa-shopping-cart text-dark px-2"></i><span>My Order Details</span>
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
                                Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
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
                                <table class="table table-bordered table-stripted">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
