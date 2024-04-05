@extends('app')

@section('content')
    <div class="form-container">
        <div class="navbar">
            <div class="navbar-nav">
                <h2>Order details</h2>
            </div>
            <div class="navbar-nav">
                <a class="general-btn" href="{{ url('/order/orders') }}">Back</a>
            </div>
        </div>

        <div class="rows">
            <div class="left-side">
                <div class="form-group">
                    <div class="forms-label">
                        <strong>Name:</strong>
                        {{ $order->name }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="forms-label">
                        <strong>Items:</strong>
                        @foreach ($order->products as $product)
                            {{ $product->name }} <br>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <div class="forms-label">
                        <strong>Address:</strong>
                        {{ $order->address }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="forms-label">
                        <strong>Total:</strong>
                        <span class="total">Php {{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="forms-label">
                        <strong>Mode of payment:</strong>
                        {{ $order->payment }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="forms-label">
                        <strong>Mode of Delivery:</strong>
                        {{ $order->mod }}
                    </div>
                </div>
            </div>

            <div class="right-side">
                <div class="form-group">
                    <div class="forms-label">
                        <strong>Status:</strong>
                        {{ $order->status }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="forms-label">
                        <strong>Product Image:</strong>
                        <br>
                        <img src="/images/{{ $product->product_image }}" width="500px">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var totals = document.querySelectorAll('.total');
        totals.forEach(function (total) {
            var orderId = total.getAttribute('data-order-id');
            var orderTotal = 0;
            var products = @json($order->products);
            products.forEach(function (product) {
                orderTotal += parseFloat(product.price);
            });
            total.textContent = 'Php ' + orderTotal.toFixed(2);
        });
    </script>
@endsection
