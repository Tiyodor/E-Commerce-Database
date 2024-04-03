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
                    <form id="deleteForm_{{ $product->id }}" action="{{route('items.destroy', $product->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn" onclick="confirmDelete('{{ $product->id }}')">Delete</button>
                    </form>
                </td>
                <td class="text-center">
                    <form id="restoreForm_{{ $product->id }}" action="{{route('items.restore', $product->id)}}" method="POST">
                        @csrf
                        <button type="button" class="btn" onclick="confirmRestore('{{ $product->id }}')">Restore</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function confirmDelete(productId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms, submit the form
                document.getElementById('deleteForm_' + productId).submit();
            }
        });
    }

    function confirmRestore(productId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This item will be restored!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms, submit the form
                document.getElementById('restoreForm_' + productId).submit();
            }
        });
    }
</script>

@endsection
