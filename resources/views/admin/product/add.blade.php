@extends("layouts.app")


@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <form method="post" action="{{route("product-store", $category)}}">
                    <h1>Add list</h1>
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
                        <input id="photo" type="file" class="form-control" name="photo">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input id="price" type="number" class="form-control" name="price" placeholder="1.00" step="0.01" min="0" max="{{PHP_INT_MAX}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
