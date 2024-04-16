@extends('app')

@section('content')
<div class="item-table roll-in">
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Inventory</h2>
        </div>
        <div class="search-bar">
            <form action="{{ route('items.search') }}" method="GET">
                <input type="text" class="search-input" name="search" placeholder="Search products">
                <button type="submit" class="btn">Search</button>
            </form>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="create">Add New Product</a>
            <a class="general-btn" href="archive">Archived Product</a>
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
                <th class="text-center">Quantity</th>
                <th class="text-center">Availability</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        {{-- @php $i = 0 @endphp --}}
        <tbody>

            @foreach ($products as $product)

            <tr>
                {{-- <td class="text-center">{{ ++$i }}</td> --}}
                <td class="text-center">{{ $product->id }}</td>
                <td class="text-center">{{ $product->name }}</td>
                <td class="text-center">{{ $product->details }}</td>
                <td class="text-center">{{ $product->category }}</td>
                <td><img src="/images/{{ $product->product_image }}" width="120" height="125" class="center" /></td>
                <td class="text-center">Php {{ $product->price }}</td>
                <td class="text-center">{{ $product->quantity }}</td>
                <td class="text-center">{{ $product->quantity > 0 ? $product->availability : 'Not Available' }}</td>
                <td class="text-center">
                    <form action="{{ route('items.destroy', $product->id) }}" method="POST">
                        <a class="btn" href="{{ route('items.show',$product->id) }}">Show</a>
                        <a class="btn" href="{{ route('items.edit',$product->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Archive</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>

    <div class="pagination">
        {!! $products->previousPageUrl() ? '<a href="' . $products->previousPageUrl() .  ' " class="btn-page">&lt; Previous</a>' : '' !!}
        {!! $products->nextPageUrl() ? '<a href="' . $products->nextPageUrl() . '" class="btn-page">Next &gt;</a>' : '' !!}
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
            timer: 3000 // 2 seconds
        });
    @endif
</script>
</div>


@endsection
