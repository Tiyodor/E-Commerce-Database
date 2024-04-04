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
                    <strong>Total:</strong>
                    <div id="total_{{ $order->id }}" > {{ $order->total }}</</div>
                </div>
            </div>

            <div class="form-groups">
                <div class="forms-label">
                    <strong>Status:</strong>
                        <a value="{{ $order->status }}">{{ $order->status }}</a>
                </div>
            </div>

            <div class="form-groups">
                <div class="forms-label">
                    <strong>Payment Method:</strong>
                    <select name="payment" class="form-input " style="width: 15%">
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
                    <select name="mod" class="form-input" style="width: 15%">
                        <option value="{{ $order->mod }}">{{ $order->mod }}</option>
                        <option value="J&T">J&T</option>
                        <option value="Lalamove">Lalamove</option>
                        <option value="Shopee">Shopee</option>
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

    @foreach ($orders as $order)
        var total_{{ $order->id }} = 0;
        @foreach ($order->products as $product)
            total_{{ $order->id }} += parseFloat("{{ $product->price }}");
        @endforeach
        document.getElementById('total_{{ $order->id }}').innerHTML = 'Php ' + total_{{ $order->id }}.toFixed(2);
    @endforeach

</script>

<script>
    function cancelOrder() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to cancel the order!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('{{ route('order.cancelDestroy', $order->id) }}', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire(
                            'Cancelled!',
                            'Your order has been cancelled.',
                            'success'
                        );
                        window.location.href = '{{ route('order.orders') }}';
                    } else {
                        console.error('Failed to cancel order.');
                        Swal.fire(
                            'Error!',
                            'Failed to cancel order.',
                            'error'
                        );
                        window.location.href = '{{ route('order.orders') }}'; // Reroute even if cancellation fails
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'Failed to cancel order.',
                        'error'
                    );
                    window.location.href = '{{ route('order.orders') }}';
                });
            }
        });
    }
</script>


@endsection
