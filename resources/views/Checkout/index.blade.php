@extends('app')

@section('content')

<div class="item-table roll-in">
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Orders</h2>
        </div>
        <div class="search-bar">
            <form action="{{ route('checkout.search') }}" method="GET">
                <input type="text" class="search-input" name="search" placeholder="Search products">
                <button type="submit" class="btn">Search</button>
            </form>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="history">Delivery History</a>
        </div>
    </div>

    <table class="product-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Product</th>
                <th class="text-center">Address</th>
                <th class="text-center">Total</th>
                <th class="text-center">Payment</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        @php $i = 0 @endphp
        <tbody>
            @foreach ($checkouts as $checkout)
            <tr>
                {{-- <td class="text-center">{{ ++$i }}</td> --}}
                <td class="text-center">{{ $checkout->id }}</td>
                <td class="text-center"> {{ $checkout->fname }} {{ $checkout->lname }} </td>
                <td class="text-center">{{ $checkout->email}}</td>

                <td class="text-center">
                    @foreach ($checkout->products as $product)
                        {{ $product->name }} <br>
                    @endforeach
                </td>
                <td class="text-center">{{ $checkout->address }}</td>
                <td class="text-center" id="total_{{ $checkout->id }}">Php {{ $checkout->total }}</td>
                <td class="text-center">{{ $checkout->payment }}</td>


                    <td class="text-center">
                        <form action="{{ route('checkout.destroy', $checkout->id) }}" method="POST">
                            <a class="btn" href="{{ route('checkout.show', $checkout->id) }}">Show</a>
                            @csrf
                            @method('DELETE')

                            <a class="btn" href=" {{ route('checkout.edit', $checkout->id)}}">Edit</a>

                            <button type="submit" class="btn">Delivered</button>
                        </form>
                    </td>


            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {!! $checkouts->previousPageUrl() ? '<a href="' . $checkouts->previousPageUrl() .  ' " class="btn-page">&lt; Previous</a>' : '' !!}
        {!! $checkouts->nextPageUrl() ? '<a href="' . $checkouts->nextPageUrl() . '" class="btn-page">Next &gt;</a>' : '' !!}
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

{{-- <script>

    @foreach ($checkouts as $checkout)
        var total_{{ $checkout->id }} = 0;
        @foreach ($checkout->products as $product)
            total_{{ $checkout->id }} += parseFloat("{{ $product->price }}");
        @endforeach
        document.getElementById('total_{{ $checkout->id }}').innerHTML = 'Php ' + total_{{ $checkout->id }}.toFixed(2);
    @endforeach

</script> --}}

@endsection
