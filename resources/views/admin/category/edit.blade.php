@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <form method="post" action="{{route("category-update", $category)}}">
                    <h1>Edit Category</h1>
                    @csrf

                    <div class="form-group">
                        <label for="name">Internal name</label>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Internal Name" value="{{$category->getName()}}" required>
                    </div>

                    <div class="form-group">
                        <label for="label">Label</label>
                        <input id="label" type="text" class="form-control" name="label" placeholder="Label" value="{{$category->getLabel()}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
