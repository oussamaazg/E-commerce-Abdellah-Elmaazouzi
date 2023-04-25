@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="me-md-3 me-xl-5">
                <h2>Dashboard,</h2>
                <p class="mb-md-0">Your analytics dashboard template.</p>
                <hr>
            </div>
            <div class="row">                
                <div class="col-md-3">
                    <div class="card card-body rounded bg-primary text-white mb-3">
                        <label>Total Orders</label>
                        <h1 class="py-4 text-center">{{ $totalOrders }}</h1>
                        <a href="{{ url('admin/orders') }}" class="btn btn-md btn-light">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body rounded bg-success text-white mb-3">
                        <label>Today Orders</label>
                        <h1 class="py-4 text-center">{{ $todayOrders }}</h1>
                        <a href="{{ url('admin/orders') }}" class="btn btn-md btn-light">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body rounded bg-warning text-white mb-3">
                        <label>This Month Orders</label>
                        <h1 class="py-4 text-center">{{ $thisMonthOrders }}</h1>
                        <a href="{{ url('admin/orders') }}" class="btn btn-md btn-light">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body rounded bg-danger text-white mb-3">
                        <label>This Year Orders</label>
                        <h1 class="py-4 text-center">{{ $thisYearOrders }}</h1>
                        <a href="{{ url('admin/orders') }}" class="btn btn-md btn-light">View</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">                
                <div class="col-md-3">
                    <div class="card card-body rounded bg-primary text-white mb-3">
                        <label>Total Products</label>
                        <h1 class="py-4 text-center">{{ $totalProducts }}</h1>
                        <a href="{{ url('admin/products') }}" class="btn btn-md btn-light">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body rounded bg-success text-white mb-3">
                        <label>Today Categories</label>
                        <h1 class="py-4 text-center">{{ $totalCategories }}</h1>
                        <a href="{{ url('admin/category') }}" class="btn btn-md btn-light">View</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">                
                <div class="col-md-3">
                    <div class="card card-body rounded bg-primary mb-3 text-light">
                        <label>All Users</label>
                        <h1 class="py-4 text-center">{{ $allUsers }}</h1>
                        <a href="{{ url('admin/users') }}" class="btn btn-md btn-light">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body rounded bg-success text-white mb-3">
                        <label>Admins</label>
                        <h1 class="py-4 text-center">{{ $totalAdmin }}</h1>
                        <a href="{{ url('admin/cateories') }}" class="btn btn-md btn-light">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body rounded bg-warning text-white mb-3">
                        <label>Users</label>
                        <h1 class="py-4 text-center">{{ $totalUser }}</h1>
                        <a href="{{ url('admin/orders') }}" class="btn btn-md btn-light">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
