remove soft delete from script

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

        @if ($errors->any())
        <script>
            window.onload = function () {
                var errorMessage = 'Whoops! There were some problems with your input.';
                @foreach ($errors->all() as $error)
                errorMessage += '{{ $error }}';
                @endforeach
                errorMessage += '';
                alert(errorMessage);
            }
        </script>
        @endif

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
                        <option value="processing">Processing</option>
                        <option value="Ofd">Out for Delivery</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn">Submit</button>
                <!-- Use JavaScript to trigger the cancel action -->
                <button type="button" class="btn-cancel" onclick="cancelOrder()">Cancel Order</button>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript function to handle cancel action -->
<script>
    function cancelOrder() {
        if (confirm('Are you sure you want to cancel this order?')) {
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
                    alert('Failed to cancel order.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to cancel order.');
            });
        }
    }
</script>
@endsection
