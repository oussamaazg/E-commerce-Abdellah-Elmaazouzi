<div>
    <div class="row">
        <div class="col-md-3">
            <div class="card my-4">
                <div class="card-header">
                    <h4>Product</h4>
                </div>
                <div class="card-body">
                    <input type="text" name="searchProduct" wire:model="productInput" class="form-control" placeholder="Search for product...." id="search">
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Price</h4>
                </div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" wire:model="priceInput" name="priceSort" value="high-to-low" /> High to
                        Low
                    </label>
                    <label class="d-block">
                        <input type="radio" wire:model="priceInput" name="priceSort" value="low-to-high" /> Low to
                        High
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row" id="Content">
                @forelse ($products as $product)
                    <div class="col-md-4">
                        <div class="product-card">
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
                                <div class="mt-2">
                                    <a href="{{ url('collections/' . $product->category->name . '/' . $product->slug) }}"
                                        class="btn btn1">Add To Cart</a>
                                    <a href="{{ url('collections/' . $product->category->name . '/' . $product->slug) }}"
                                        wire:click="addToWishlist({{ $product->id }})" class="btn btn1">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <a href="{{ url('collections/' . $product->category->name . '/' . $product->slug) }}"
                                        class="btn btn1"> View </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <h4 class="alert alert-info" role="alert">No Product Available for <span class="alert-link"
                                style="text-decoration: underline">{{ $category->name }}</span></h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
