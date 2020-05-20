@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Categories</div>

                    <div class="card-body">
                        @foreach(\App\Category::all() as $category)
                            <div class="card">
                                <h5 class=" card-header">{{$category->getLabel()}}</h5>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($category->getProducts() as /**@var \App\Product*/ $product )
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <details class="card-body">
                                                        <summary class="card-header">{{$product->getLabel()}}</summary>

                                                        <p class="card-text">Internal Name: {{$product->getName()}}</p>
                                                        <p class="card-text">Label: {{$product->getLabel()}}</p>
                                                        <p class="card-text">Description: {{$product->getDescription()}}</p>
                                                        <p class="card-text">Price: ${{$product->getPrice()}}</p>
                                                        <img class="card-img" src="{{asset("uploads/products/" . $product->getId() . "/x512.png")}}"
                                                             alt="{{$product->getName()}}">

                                                        <div>
                                                            <a href="{{route("product-edit", $product)}}" class="btn btn-success">Edit
                                                                Product</a>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                                    data-target="#removeModalP{{$product->getId()}}">Remove Product
                                                            </button>
                                                        </div>
                                                    </details>

                                                </div>
                                            </div>

                                            <div class="modal fade" id="removeModalP{{$product->getId()}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure to remove this product?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                Cancel
                                                            </button>
                                                            <a id="removeButton" type="button" class="btn btn-danger"
                                                               href="{{route("product-destroy", $product)}}">Remove Product</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                                <div>
                                    <a href="{{route("category-edit", $category)}}" class="btn btn-success">Edit
                                        Category</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#removeModalC{{$category->getId()}}">Remove Category
                                    </button>
                                    <a href="{{route("product-add", $category)}}" class="btn btn-primary">Add
                                        Product</a>
                                </div>

                                <div class="modal fade" id="removeModalC{{$category->getId()}}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to remove this category?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <a id="removeButton" type="button" class="btn btn-danger"
                                                   href="{{route("category-destroy", $category)}}">Remove Category</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                        <a href="{{route("category-add")}}" class="btn btn-primary">Add Category</a>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">Orders</div>

                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
