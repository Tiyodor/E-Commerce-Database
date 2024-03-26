@extends('app')

@section('content')

<link rel="stylesheet" type="text/css" href='css/home.css'>

<div class="homecontainer grow">
    <div class="product-container pulse">
        <header>Latest Products</header>
        <div class="contents">

            <table class="product-table">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Details</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0 @endphp <!-- Define $i here -->

                    @foreach ($products as $product)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td class="text-center">{{ $product->name }}</td>
                        <td class="text-center">{{ $product->details }}</td>
                        <td class="text-center">{{ $product->category }}</td>
                        <td class="text-center">Php {{ $product->price }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

         </div>
    </div>
    <div class="user-container pulse">
        <header>Users</header>
        <div class="contents">
            <table class="user-table">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                </tr>
                @php $i = 0 @endphp <!-- Define $i here -->
                @foreach ($users as $user)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td class="text-center">{{ $user->name }}</td>
                        <td class="text-center">{{ $user->address }}</td>
                        <td class="text-center">{{ $user->email }}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
    <div class="order-container pulse">
        <header>Order Info</header>
        <div class="contents">
            <table class="product-table">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Product</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Payment</th>
                        <th class="text-center">Mode of Delivery</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0 @endphp <!-- Define $i here -->

                    @foreach ($orders as $order)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td class="text-center">{{ $order->name }}</td>
                        <td class="text-center">
                            @foreach ($order->products as $product)
                                {{ $product->name }} <br>
                            @endforeach
                        </td>
                        <td class="text-center">{{ $order->address }}</td>
                        <td class="text-center" id="total_{{ $order->id }}">Php {{ $order->total }}</td>
                        <td class="text-center">{{ $order->payment }}</td>
                        <td class="text-center">{{ $order->mod }}</td>
                        <td class="text-center">{{ $order->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <script>

            // Calculate and display total price for each order
            @foreach ($orders as $order)
                var total_{{ $order->id }} = 0;
                @foreach ($order->products as $product)
                    total_{{ $order->id }} += parseFloat("{{ $product->price }}");
                @endforeach
                document.getElementById('total_{{ $order->id }}').innerHTML = 'Php ' + total_{{ $order->id }}.toFixed(2);
            @endforeach

        </script>


@endsection
