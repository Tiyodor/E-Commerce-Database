@extends('app')

@section('content')
<div class="edit-container">
    <div class="navbar">
        <div class="navbar-nav">
            <h2> Edit order details</h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{ url('/order/orders') }}"> Back </a>
        </div>
    </div>

    <form action="{{ route('order.update', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="form-groups">
                <div class="forms-label">
                    <strong>Name:</strong>
                    @foreach ($order->products as $product)
                    {{ $order->name }} <br>
                    @endforeach
                </div>
            </div>
            <div class="form-groups">
                <div class="forms-label">
                    <strong>Items:</strong>
                    @foreach ($order->products as $product)
                    {{ $product->name }} <br>
                    @endforeach
                </div>
            </div>
            <div class="form-groups">
                <div class="forms-label">
                    <strong>Total: Php</strong>
                    <div id="total_{{ $order->id }}" style="height:50px"> {{ $order->total }}</</div>
                </div>
            </div>
            <div class="form-groups">
                <div class="forms-label">
                    <strong>Payment Method:</strong>
                    <select name="payment" class="form-input">
                        <option value="{{ $order->payment }}">{{ $order->payment }}</option>
                        <option value="COD">Cash on Delivery</option>
                        <option value="Bank">Bpi, Bpo, Metrobank, Etc</option>
                        <option value="Gcash">Gcash</option>
                    </select>
                </div>
            </div>

            <div class="form-groups">
                <div class="forms-label">
                    <strong>Mode of Delivery:</strong>
                    <select name="mod" class="form-input">
                        <option value="{{ $order->mod }}">{{ $order->mod }}</option>
                        <option value="J&T">J&T</option>
                        <option value="Lalamove">Lalamove</option>
                        <option value="Shopee">Shopee</option>
                    </select>
                </div>
            </div>

            <div class="form-groups">
                <div class="forms-label">
                    <strong>Status:</strong>
                    <select name="status" class="form-input">
                        <option value="{{ $order->status }}">{{ $order->status }}</option>
                        <option value="processing">Processing</option>
                        <option value="Ofd">Out for Delivery</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn">Submit</button>
                <button type="button" class="btn-cancel" onclick="cancelOrder()">Cancel Order</button>
            </div>
        </div>
    </form>
</div>

<script>
    function cancelOrder() {
        fetch('{{ route('order.cancelDestroy', $order->id) }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '{{ route('order.orders') }}';
            } else {
                console.error('Failed to cancel order.');
                window.location.href = '{{ route('order.orders') }}'; // Reroute even if cancellation fails
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to cancel order.');
            window.location.href = '{{ route('order.orders') }}';
        });
    }
</script>


@endsection
