@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="me-auto">Products</h3>
                <form action="{{ route('products.import') }}" class="d-flex align-items-center" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="file" name="file" class="form-control" style="width: 200px; height: 5;"   />
                    <button class="btn btn-warning btn-sm text-white mx-2">
                        Import Products
                    </button>
                </form>
                <form action="{{ route('products.export') }}">
                    <button class="btn btn-info btn-sm text-white mx-2 ">
                        Export Products
                    </button>
                </form>
                <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white">Add
                    Products
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if ($product->category)
                                        {{ $product->category->name }}
                                    @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->selling_price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->status == '0' ? 'Hidden' : 'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/products/' . $product->id . '/edit') }}"
                                        class="btn btn-sm btn-success text-light">Edit</a>
                                    <a href="{{ url('admin/products/' . $product->id . '/delete') }}"
                                        onclick="return confirm('Are you sure, you want to delete this data?')"
                                        class="btn btn-sm btn-danger text-light">Delete</a>
                                    <!-- Button trigger modal -->
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Products Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
