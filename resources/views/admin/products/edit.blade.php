@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Edit Product
                    <a href="{{ url('admin/products') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/products/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#details-tab-pane" type="button" role="tab"
                                aria-controls="details-tab-pane" aria-selected="false">Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane"
                                type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Products
                                Image</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-3" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <div class="mt-3 mb-3">
                                <label class="p-2">Category:</label>
                                <select name="category_id" class="form-select m-2" aria-label="Default select example">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="mb-3">
                                <label>Product Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
                            </div>
                            @error('slug')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                            </div>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="tab-pane fade p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab"
                            tabindex="0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mt-3 mb-3">
                                        <label>Original Price</label>
                                        <input type="number" name="original_price" class="form-control"
                                            value="{{ $product->original_price }}">
                                    </div>
                                    @error('original_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="mb-3">
                                        <label>Selling Price</label>
                                        <input type="number" name="selling_price" class="form-control"
                                            value="{{ $product->selling_price }}">
                                    </div>
                                    @error('selling_price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <input type="checkbox" name="status" style="width: 15px; height: 15px;"
                                            {{ $product->status == '1' ? 'checked' : '' }}>
                                    </div>
                                    <div class="mb-3">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control"
                                            value="{{ $product->quantity }}">
                                    </div>
                                    @error('quantity')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab"
                            tabindex="0">
                            <div class="mt-3 mb-3">
                                <label>Upload Product images</label>
                                <input type="file" name="image[]" class="form-control" multiple>
                            </div>
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div>
                                @if ($product->productImages())
                                    @foreach ($product->productImages as $image)
                                        <img src="{{ asset($image->image) }}" alt="img"
                                            class="me-2 border border-primary rounded" style="width: 80px; height: 80px;">
                                        <a href="{{ url('admin/product-image/' . $image->id . '/delete') }}"
                                            class="me-2 btn btn-sm btn-danger rounded-4 text-light align-center">Remove
                                            <span class="mdi mdi-delete-circle-outline w-4"></span>
                                        </a>
                                    @endforeach
                                @else
                                    <h5 class="me-4">No Image Added</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="py-2 float-end">
                        <button type="submit" class="btn btn-success text-light">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
