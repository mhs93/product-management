@extends('frontend.layouts.app')

@section('content')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddImageModal" data-bs-whatever="@mdo">Add</button>
    <div class="container">
        <div class="row">
            @foreach($images as $image)
                <div class="card" style="width: 18rem;">
                    <img src="{{ $image->image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $image->name }}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Add Image Modal -->
    <div class="modal fade" id="AddImageModal" tabindex="-1" aria-labelledby="AddImageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddImageModalLabel">Add New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('image.store') }}" method="post" id="addImageForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="imageName" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="imageName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="imageFile" class="col-form-label">Image:</label>
                            <input type="file" class="form-control" id="imageFile" name="image" accept="image/*" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveImageButton">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
$(document).ready(function () {
    $('#addImageForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "{{ route('image.store') }}",
            data: formData,
            method: "post"
        })
    })
})

</script>