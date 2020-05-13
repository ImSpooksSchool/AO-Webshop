@extends("layouts.app")

@section("head")
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css" rel="stylesheet">
@endsection

@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <form method="post" enctype="multipart/form-data" action="{{route("product-update", $product)}}">
                    <h1>Add Product</h1>
                    @csrf
                    <div class="form-group">
                        <label for="name">Internal name</label>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Internal Name" value="{{$product->getName()}}" required>
                    </div>

                    <div class="form-group">
                        <label for="label">Label</label>
                        <input id="label" type="text" class="form-control" name="label" placeholder="Label" value="{{$product->getLabel()}}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" type="text" class="form-control" name="description" placeholder="Description">{{$product->getDescription()}}</textarea>
                    </div>

{{--                TODO upload file --}}
                    <div class="form-group">
                        <label for="photo" title="Max file size is 10 MB">Photo</label>
                        <input id="photo" type="file" class="form-control ignore-submit" name="photo">
                        <img id="result" src="{{asset($product->getPhoto() . "x512.png")}}" alt="photo-cropped">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input id="price" type="number" class="form-control" name="price" value="{{asset($product->getPrice())}}" step="0.01" min="0" max="{{PHP_INT_MAX}}">
                    </div>

                    {{-- Encoded with Base64 --}}
                    <textarea id="photo_encoded" name="photo" type="text" hidden></textarea>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Edit</button>
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
