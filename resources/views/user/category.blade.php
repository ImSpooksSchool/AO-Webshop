@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body">
                        <div class="row">
                        @foreach ($category->getProducts() as /**@var \App\Product*/ $product)
                            <div class="col-sm-4">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$product->getLabel()}}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{$product->getName()}}</h6>

                                        <p class="card-text">Price: ${{$product->getPrice()}}</p>
                                        <img class="card-img"
                                             src="{{asset("uploads/products/" . $product->getId() . "/x512.png")}}"
                                             alt="{{$product->getName()}}">

                                        <a style="margin-top: 18px" class="btn btn-primary"
                                           href="{{route("show-product", $product)}}">Go to product</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("js")
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
