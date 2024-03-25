@extends('app')

@section('content')

<div class="item-table roll-in">
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Orders</h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="create">Add Order</a>

            <a class="general-btn" href="archive">Archived Order</a>
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
                <td class="text-center">{{ $order->product }}</td>
                <td class="text-center">{{ $order->address }}</td>
                <td class="text-center">Php {{ $order->total }}</td>
                <td class="text-center">{{ $order->mod }}</td>
                <td class="text-center">{{ $order->status }}</td>
                <td class="text-center">
                    <form action="{{route('destroy', $order->id)}}" method="POST">
                        <a class="btn" href="{{route('items.show',$order->id)}}">Show</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {!! $orders->previousPageUrl() ? '<a href="' . $orders->previousPageUrl() .  ' " class="btn-page">&lt; Previous</a>' : '' !!}
        {!! $orders->nextPageUrl() ? '<a href="' . $orders->nextPageUrl() . '" class="btn-page">Next &gt;</a>' : '' !!}
    </div>
</div>

@endsection
