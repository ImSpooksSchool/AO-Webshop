@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Categories</div>

                    <div class="card-body">
                        @foreach(\App\Category::all() as $category)
                            <div class="card" style="margin-bottom: 10px">
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

            <div class="col-md-12">
                <div class="card" style="margin-top: 10px">
                    <div class="card-header">Orders</div>
                    <div class="card-body">
                        @foreach(\App\Order::all() as $order)
                            <div class="card">
                                <details class="card-body">
                                    <summary class="card-header">
                                        @if($order->isHandled())
                                            <i style="color: dimgray">
                                        @endif
                                        Order {{$order->getId()}}
                                        @if($order->isHandled())
                                            </i>
                                        @endif
                                    </summary>

                                    <p class="card-text">
                                        Handled:
                                        @if($order->isHandled())
                                            Yes
                                        @else
                                            No
                                        @endif<br>

                                        Name: {{$order->getFullname()}}<br>
                                        Country: {{$order->getCountry()}}<br>
                                        State: {{$order->getState()}}<br>
                                        City: {{$order->getCity()}}<br>
                                        Street: {{$order->getStreet()}}<br>
                                        Zip: {{$order->getZip()}}<br>
                                        Phone: {{$order->getPhone()}}<br>
                                        <br>
                                        Products:
                                    </p>
                                    <ul>
                                        @foreach($order->getProducts() as $product => $amount)
                                            @php($product = \App\Product::find($product))
                                            <li>{{$product->getLabel()}}: {{$amount}}</li>
                                        @endforeach
                                    </ul>

                                    <a style="margin-top: 18px" class="btn btn-primary"
                                       href="{{route("handle-order", $order)}}">Toggle handled status</a>
                                </details>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
