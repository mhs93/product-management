<table class="table">

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add</button>
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
            <th scope="row">{{ $key+1 }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->subcategory_id ? $product->subcategory->name : '' }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->color }}</td>
            <td>{{ $product->quantity }}</td>
            <td>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" >Edit</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>




<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="errorMessages" style="display:none; color: red;"></div>
                <form action="{{ route('product.store') }}" method="post" id="productForm">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" name="name" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Category:</label>
                        <select name="category_id" class="form-select" aria-label="Default select example" required>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Sub Category:</label>
                        <select name="subcategory_id" class="form-select" aria-label="Default select example">
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Color:</label>
                        <input name="color" type="text" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Price:</label>
                        <input type="number" name="price" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Quantity:</label>
                        <input type="text" name="quantity" class="form-control" id="recipient-name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="save" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $('#save').click(function (e) {
            e.preventDefault()
            let formData = $('#productForm').serialize()
            $.ajax({
                url: " {{ route('product.store') }}",
                method: "POST",
                data: formData,
                success: function (response) {
                    alert(response.msg)
                    location.reload()
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<ul>';
                        $.each(errors, function (key, value) {
                            errorHtml += `<li>${value[0]}</li>`;
                        });
                        errorHtml += '</ul>';
                        $('#errorMessages').html(errorHtml).show(); // Show error messages
                    } else {
                        console.error('An error occurred:', xhr.responseText);
                    }
                }
            })
        })
    })
</script>