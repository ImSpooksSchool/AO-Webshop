@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">{{$product->getLabel()}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$product->getName()}}</h6>

                        <div class="row border rounded" style="padding: 10px; margin-bottom: 5px">
                            <div class="col-6">
                                <img class="card-img"
                                     src="{{asset("uploads/products/" . $product->getId() . "/x512.png")}}"
                                     alt="{{$product->getName()}}">
                            </div>
                            <div class="col-3">
                                <p class="card-text">{{$product->getDescription()}}</p>
                            </div>
                        </div>

                        <p class="card-text">Price: ${{$product->getPrice()}}</p>


                        <a style="margin-top: 18px" class="btn btn-primary"
                           href="{{route("add-to-cart", $product)}}">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
