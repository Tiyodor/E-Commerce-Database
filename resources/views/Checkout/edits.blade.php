@extends('app')

@section('content')
<div class="edit-container">
    <div class="navbar">
        <div class="navbar-nav">
            <h2> Edit order details</h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{ url('/checkout/checkouts') }}"> Back </a>
        </div>
    </div>

    <form action="{{ route('checkout.update', $checkout->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="form-groups">
                <div class="forms-label">
                    <strong>Name:</strong>
                    {{ $checkout->name }}
                </div>
            </div>

            <div class="form-groups">
                <div class="forms-label">
                    <strong>Items:</strong>
                    @foreach ($checkout->products as $product)
                        {{ $product->name }} <br>
                    @endforeach
                </div>
            </div>

            <div class="form-groups">
                <div class="forms-label">
                    <strong>Total:</strong>
                    <span class="total">Php {{ number_format($checkout->total, 2) }}</span>
                </div>
            </div>

            <div class="form-groups">
                <div class="forms-label">
                    <strong>Payment Method:</strong>
                    <select name="payment" class="form-input " style="width: 15%">
                        <option value="{{ $checkout->payment }}">{{ $checkout->payment }}</option>
                        <option value="Bank">Bank</option>
                        <option value="ewallet">Gcash</option>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                fetch('{{ route('checkout.cancelDestroy', $checkout->id) }}', {
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
                    } else {
                        console.error('Failed to cancel order.');
                    }
                    window.location.href = '{{ route('checkout.index') }}';
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.location.href = '{{ route('checkout.index') }}';
                });
            }
        });
    }
</script>

@endsection
