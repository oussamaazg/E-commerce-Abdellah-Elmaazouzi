<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Product Name</th>
        <th>Product Slug</th>
        <th>Description</th>
        <th>Original Price</th>
        <th>Selling Price</th>
        <th>Quantity</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->slug }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->original_price }}</td>
            <td>{{ $product->selling_price }}</td>
            <td>{{ $product->quantity }}</td>
        </tr>
    @endforeach
    </tbody>
</table>