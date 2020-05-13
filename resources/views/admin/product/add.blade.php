@extends("layouts.app")

@section("head")
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css" rel="stylesheet">
@endsection

@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <form method="post" enctype="multipart/form-data" action="{{route("product-store", $category)}}">
                    <h1>Add Product</h1>
                    @csrf
                    <div class="form-group">
                        <label for="name">Internal name</label>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Internal Name" required>
                    </div>

                    <div class="form-group">
                        <label for="label">Label</label>
                        <input id="label" type="text" class="form-control" name="label" placeholder="Label">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" type="text" class="form-control" name="description" placeholder="Description"></textarea>
                    </div>

{{--                TODO upload file --}}
                    <div class="form-group">
                        <label for="photo" title="Max file size is 10 MB">Photo</label>
                        <input id="photo" type="file" class="form-control ignore-submit" name="photo">
                        <img id="result" src="https://via.placeholder.com/512" alt="photo-cropped">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input id="price" type="number" class="form-control" name="price" value="1.00" step="0.01" min="0" max="{{PHP_INT_MAX}}">
                    </div>

                    {{-- Encoded with Base64 --}}
                    <textarea id="photo_encoded" name="photo" type="text" hidden>
                        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
                    </textarea>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("js")
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js" type="text/javascript"></script>
    <script src="{{asset("js/product_cropper.js")}}" type="text/javascript"></script>
@endpush
