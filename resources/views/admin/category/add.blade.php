@extends("layouts.app")


@section("content")

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <form method="post" action="{{route("category-store")}}">
                    <h1>Add Category</h1>
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
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
