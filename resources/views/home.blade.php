@extends('app')

@section('content')

<link rel="stylesheet" type="text/css" href='css/home.css'>

<div class="container">
    <div class="product-container">
        <header>Latest Products</header>
        <div class="contents">

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Category</th>
                    <th>Product Image</th>
                   <th>Price</th>
                </tr>

                @foreach ($products as $product)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td class="text-center">{{ $product->name }}</td>
                        <td class="text-center">{{ $product->details }}</td>
                        <td class="text-center">{{ $product->category }}</td>
                        <td class=""><img src="/images/{{ $product->product_image }}" width="150" class="center" /></td>
                        <td class="text-center">Php {{ $product->price }}</td>
                    </tr>
                @endforeach
            </table>

    </div>
    <div class="user-container">
        <header>Users</header>
        <div class="contents">
            <!-- User content goes here -->
        </div>
    </div>
</div>


@endsection
