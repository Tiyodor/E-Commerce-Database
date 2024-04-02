@extends('app')

@section('content')
<div class="item-table">
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Archives</h2>

        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{url('/items/index')}}"> Back </a>
        </div>
    </div>

    <table class="product-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Name</th>
                <th class="text-center">Details</th>
                <th class="text-center">Category</th>
                <th class="text-center">Product Image</th>
                <th class="text-center">Price</th>
                <th class="text-center">Action</th>
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
                <td><img src="/images/{{ $product->product_image }}" width="145"  class="center" /></td>
                <td class="text-center">Php {{ $product->price }}</td>
                <td class="text-center">
                    <form action="{{route('items.destroy', $product->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Delete</button>
                    </form>

                </td>
                <td>
                    <form action="{{route('items.restore', $product->id)}}" method="POST">
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
