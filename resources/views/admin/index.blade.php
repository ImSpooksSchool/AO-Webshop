@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Categories</div>

                    <div class="card-body">
                        <div class="row"></div>
                            @foreach(\App\Category::all() as $category)
                                <div class="col-sm container card">
                                    <h5 class=" card-title">{{$category->getLabel()}}</h5>
                                    @foreach ($category->getProducts() as /**@var \App\Product*/ $product )
                                        <details class="card-body border rounded">
                                            <summary class="card-title">{{$product->getName()}}</summary>
                                            <p class="card-text">{{$product->getDescription()}}</p>

                                            <div class="product_buttons">
                                                <a href="{{route("product-edit", $product)}}" class="col-sm btn btn-success">Edit Product</a>
                                            </div>
                                        </details>
                                    @endforeach
                                    <div class="category_buttons">
                                        <a href="{{route("category-edit", $category)}}" class="col-sm btn btn-success">Edit Category</a>
                                        <a href="{{route("product-add", $category)}}" class="col-sm btn btn-primary">Add Product</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{route("category-add")}}" class="col-sm btn btn-primary">Add Category</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
