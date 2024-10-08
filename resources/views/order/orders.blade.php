@extends('app')

@section('content')

<div class="item-table roll-in">
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Orders</h2>
        </div>
        <div class="search-bar">
            <form action="{{ route('order.search') }}" method="GET">
                <input type="text" class="search-input" name="search" placeholder="Search products">
                <button type="submit" class="btn">Search</button>
            </form>
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
        @php $i = 0 @endphp
        <tbody>
            @foreach ($orders as $order)
            <tr>
                {{-- <td class="text-center">{{ ++$i }}</td> --}}
                <td class="text-center">{{ $order->id }}</td>
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
                        @method('PUT')
                        <select name="status" class="dropdown" onchange="this.form.submit()">
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="OFD" {{ $order->status === 'OFD' ? 'selected' : '' }}>OFD (Out for Delivery)</option>
                        </select>
                    </form>

                    <td class="text-center">
                        <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                            <a class="btn" href="{{ route('order.show', $order->id) }}">Show</a>
                            @csrf
                            @method('DELETE')

                            <a class="btn {{ $order->status === 'OFD' ? 'disabled' : '' }}" href="{{ $order->status === 'processing' ? route('order.edit', $order->id) : '#' }}">Edit</a>

                            <button type="submit" class="btn" {{ $order->status === 'processing' ? 'disabled' : '' }} >Delivered</button>
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
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
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

@endsection
