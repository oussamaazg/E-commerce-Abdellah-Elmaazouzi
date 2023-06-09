@extends('layouts.app')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <livewire:frontend.product.view :product="$product" :category="$category">
@endsection
