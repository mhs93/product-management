<button >Add</button>

<table class="table">
    <thead>
    <tr>
        <th scope="col">SL</th>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th scope="col">Sub Category</th>
        <th scope="col">Color</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($products as $key=>$product)
        <tr>
            <th scope="row">{{ $key }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->subcategory->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->color }}</td>
            <td>{{ $product->quantity }}</td>
        </tr>
        @endforeach

    </tbody>
</table>