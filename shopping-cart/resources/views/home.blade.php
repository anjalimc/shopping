@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Products</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Poduct Name</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</th>
                                <td>PC</th>
                                <td>25</th>
                                <td><a href="/products?id=1&nm=PC&pr=25">Add to Cart</a></td>
                            </tr>
                            <tr>
                                <td>2</th>
                                <td>CPU</th>
                                <td>10</th>
                                <td><a href="/products?id=2&nm=CPU&pr=10">Add to Cart</a></td>
                            </tr>
                            <tr>
                                <td>3</th>
                                <td>Monitor</th>
                                <td>30</th>
                                <td><a href="/products?id=3&nm=Monitor&pr=30">Add to Cart</a></td>
                            </tr>
                    </table>

                    <h2>Cart</h2>
                    <div class="row">

                        <?php
                            $products = Session::get('products');
                            $i = 1;
                            $total = 0;
                            if($products) {
                                foreach($products as $product) {
                                    echo $i.". ".$product['product_name'];
                                    echo "\n";
                                    $i++;
                                    $total += $product['product_qty'];
                                }
                                echo "Total: ".$total;
                            } else {
                                echo "Cart is empty";
                            }
                        ?>
                    </div>
                    <a href="/place-order">Place Order</a>

                    <h2>Orders</h2>
                    <div class="row">

                        <?php
                            $orders = Session::get('orders');
                            $i = 1;
                            $total = 0;
                            if($orders) {
                                foreach($orders as $order) {
                                    echo $i.". ".$order['product_name'];
                                    echo "\n";
                                    $i++;
                                    // $total += $order['product_qty'];
                                }
                                // echo "Total: ".$total;
                            } else {
                                echo "No orders!";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
