@extends('app')

@section('content')

<div class="item-table roll-in">
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Orders</h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="create">Add Order</a>

            <a class="general-btn" href="history">Delivery History</a>
        </div>
    </div>

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
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
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
                <td class="text-center">
                    <form action="{{ route('order.statusUpdate', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->
                        <select name="status" onchange="this.form.submit()">
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="ofd" {{ $order->status === 'ofd' ? 'selected' : '' }}>OFD (Out for Delivery)</option>
                        </select>
                    </form>

                    <td class="text-center">
                        <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                            <a class="btn" href="{{ route('order.show', $order->id) }}">Show</a>
                            @csrf
                            @method('DELETE')

                            <!-- Edit button with conditional disable -->
                            <a class="btn {{ $order->status === 'ofd' ? 'disabled' : '' }}" href="{{ $order->status === 'processing' ? route('order.edit', $order->id) : '#' }}">Edit</a>

                            <button type="submit" class="btn ">Delivered</button>
                        </form>
                    </td>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {!! $orders->previousPageUrl() ? '<a href="' . $orders->previousPageUrl() .  ' " class="btn-page">&lt; Previous</a>' : '' !!}
        {!! $orders->nextPageUrl() ? '<a href="' . $orders->nextPageUrl() . '" class="btn-page">Next &gt;</a>' : '' !!}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Check if the session variable 'success' is set
        @if(session('success'))
            // Display a SweetAlert with the success message
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000 // 2 seconds
            });
        @endif
    </script>
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
