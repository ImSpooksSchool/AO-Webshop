@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @php($total = 0)
                            @foreach(\App\ShoppingCart::getInstance()->getProducts() as $product => $amount)
                                {{-- Convert product ID to product object--}}
                                @php($product = \App\Product::find($product))
                                @php($data_field = "product_". $product->getId())

                                <tr id="{{$data_field}}" class="product">
                                    <td><img src="{{asset("uploads/products/" . $product->getId() . "/x64.png")}}" alt="{{$product->getName()}}"></td>
                                    <td>{{$product->getLabel()}}</td>
{{--                                    <td><input class="form-control" type="text" value="{{$amount}}" /></td>--}}

                                    <td>
                                        <div class="input-group">
                                            <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="{{$data_field}}_input"><i class="fas fa-minus"></i></button>
                                            <input type="text" id="{{$data_field}}_input" name="{{$data_field}}_input" class="form-control input-number" value="{{$amount}}" min="1" max="{{PHP_INT_MAX}}">
                                            <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="{{$data_field}}_input"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </td>

                                    @php($total += $product->getPrice() * $amount)
                                    <td id="{{$data_field}}_price" price="{{$product->getPrice()}}">${{$product->getPrice() * $amount}}</td>
                                    <td class="text-center"><button class="btn btn-sm btn-danger btn-number" data-type="delete" data-field="{{$data_field}}"><i class="fa fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><a class="btn btn-primary" href="{{route("cart-order")}}">Order</a></td>
                                <td></td>
                                <td></td>
                                <td><h5>Total</h5></td>
                                <td class="text-right" id="total-price"><h5><strong>${{$total}}</strong></h5></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("js")
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            function onChange(element, newValue) {
                var parent = document.getElementById(element.id.replace(new RegExp("_input", "g"), ""));

                $("div.spanner").addClass("show");
                $("div.overlay").addClass("show");

                console.log("Sending request: " + JSON.stringify({_token: "{{csrf_token()}}", id: parseInt(element.id.split("_")[1]), newVal: newValue}, null, 4));
                $.post("{{route("cart-set")}}", {_token: "{{csrf_token()}}", id: parseInt(element.id.split("_")[1]), newVal: newValue})
                    .done(function (response) {

                        if (response.response) {
                            element.value = newValue;

                            if (newValue === 0) {
                                parent.remove();
                            } else {
                                var price = document.getElementById(parent.id + "_price");
                                var pricePer = parseFloat($(price).attr("price"));
                                price.innerText = "$" + (newValue * pricePer).toFixed(2);

                                var total = document.getElementById("total-price").children[0].children[0];
                                var totalPrice = 0;

                                for (let element of document.getElementsByClassName("product")) {
                                    console.log(element);

                                    price = document.getElementById(element.id + "_price");
                                    pricePer = parseFloat($(price).attr("price"));
                                    var quantity = parseInt(document.getElementById(element.id + "_input").value);

                                    totalPrice += pricePer * quantity;
                                }

                                total.innerText = "$" + totalPrice.toFixed(2);
                            }
                        }
                    })
                    .fail(function (response) {
                        console.log(response);
                    }).always(function () {
                        $("div.spanner").removeClass("show");
                        $("div.overlay").removeClass("show");
                    });
            }

            $(".btn-number").click(function(event) {
                event.preventDefault();

                var type = $(this).attr("data-type");
                var field = $(this).attr("data-field");

                var element = document.getElementById(field);

                switch(type.toLowerCase()) {
                    case "minus":
                        onChange(element, parseInt(element.value) - 1);
                        break;
                    case "plus":
                        onChange(element, parseInt(element.value) + 1);
                        break;
                    case "delete":
                        onChange(element, 0);
                        break;
                }
            });

            $(".input-number").change(function () {
                onChange(this, parseInt(this.value));
            });
        });
    </script>
@endpush
