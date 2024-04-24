@extends('app')

@section('content')

<div class="item-table roll-in">
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Delivered Achives</h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{url('/checkout/checkouts')}}">Back</a>
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
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0 @endphp <!-- Define $i here -->
            @foreach ($checkouts as $checkout)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td class="text-center">{{ $checkout->name }}</td>
                <td class="text-center">
                    @foreach ($checkout->products as $product)
                        {{ $product->name }} <br>
                    @endforeach
                </td>
                <td class="text-center">{{ $checkout->address }}</td>
                <td class="text-center" id="total_{{ $checkout->id }}">Php {{ $checkout->total }}</td>
                <td class="text-center">{{ $checkout->payment }}</td>
                <td class="text-center">{{ $checkout->status }}</td>
                <td class="text-center">
                    <form action="{{ route('checkout.destroy', $checkout->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Delete</button>
                    </form>
                </td>
                <td >
                    <form action="{{ route('checkout.restore', $checkout->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn">Restore</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
