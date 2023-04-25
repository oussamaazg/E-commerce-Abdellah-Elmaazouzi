@extends('layouts.app')

@section('title', 'Search Products')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>Search Results</h4>
                    <div class="underline mb-4"></div>
                </div>
                @forelse ($searchProducts as $product)
                    <div class="col-md-10">
                        <div class="product-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-card-img">
                                        @if ($product->quantity > 0)
                                            <label class="stock bg-success">In Stock</label>
                                        @else
                                            <label class="stock bg-danger">Out of Stock</label>
                                        @endif
                                        @if ($product->productImages->count() > 0)
                                            <a
                                                href="{{ url('/collections/' . $product->category->name . '/' . $product->slug) }}">
                                                <img src="{{ asset($product->productImages[0]->image) }}"
                                                    alt="{{ $product->name }}" />
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $product->slug }}</p>
                                        <h5 class="product-name">
                                            <a
                                                href="{{ url('/collections/' . $product->category->name . '/' . $product->slug) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">${{ $product->selling_price }}</span>
                                            <span class="original-price">${{ $product->original_price }}</span>
                                        </div>
                                        <p style="height: 45px; overflow: hidden;">
                                            <b>Description : </b>{{ $product->description }}
                                        </p>
                                        <a href="{{ url('/collections/' . $product->category->name . '/' . $product->slug) }}" class="btn btn-outline-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <h4 class="alert alert-info" role="alert">No Products Found</h4>
                    </div>
                @endforelse
                <div>
                    {{ $searchProducts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
