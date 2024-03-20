@extends('app')

@section('content')

<link rel="stylesheet" type="text/css" href='css/home.css'>

<div class="container">
    <div class="product-container">
        <header>Latest Products</header>
        <div class="contents">
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name: </strong>
                    {{$product->name}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Details: </strong>
                    {{$product->details}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category: </strong>
                    {{$product->category}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product Image: </strong>
                    <img src="/images/{{ $product->product_image }}" width="500px">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price: </strong>
                    {{$product->price}}
                </div>
            </div>
        </div>
    </div>
    <div class="user-container">
        <header>Users</header>
        <div class="contents">
            <!-- User content goes here -->
        </div>
    </div>
</div>

@endsection
