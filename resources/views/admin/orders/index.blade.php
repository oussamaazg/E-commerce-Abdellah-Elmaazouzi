@extends('layouts.admin')

@section('title', 'Clients Orders')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3> Clients Orders </h3>
                </div>
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="fw-bold py-2">Filter by Date:
                                    <span class="mdi mdi-arrow-down-right-bold"></span>
                                </label>
                                <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="fw-bold py-2">Filter by Status:
                                    <span class="mdi mdi-arrow-down-right-bold"></span>
                                </label>

                                <select name="status" class="form-select">
                                    <option value="">Select all Status</option>
                                    <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>In progress</option>
                                    <option value="completed {{ Request::get('status') == 'completed' ? 'selected' : ''  }}">Completed</option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : ''  }}>Pending</option>
                                    <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="our-for-delivery" {{ Request::get('status') == 'our-for-delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <br />
                                <br />
                                <button class="btn btn-sm btn-primary text-light" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                    <hr />

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Username</th>
                                    <th>Payment Mode</th>
                                    <th>Ordered Date</th>
                                    <th>Status Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->fullname }}</td>
                                        <td>{{ $order->payment_mode }}</td>
                                        <td>{{ $order->created_at->format('d-m-y') }}</td>
                                        <td>{{ $order->status_message }}</td>
                                        <td>
                                            <a href="{{ url('admin/orders/' . $order->id) }}"
                                                class="btn btn-primary btn-sm text-light">View</a>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7">No Orders Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
