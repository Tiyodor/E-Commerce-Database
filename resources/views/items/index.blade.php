@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Inventory</h2>
            </div>
            <div class="pull-right" style="margin-bottom:10px;">
                <a class="btn btn-success" href="create">Add new product</a>
            </div>
        </div>
    </div>


        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th>Category</th>
            <th>Product Image</th>
           <th>Price</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($products as $product)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td class="text-center">{{ $product->name }}</td>
                <td class="text-center">{{ $product->details }}</td>
                <td class="text-center">{{ $product->category }}</td>
                <td class=""><img src="/images/{{ $product->product_image }}" width="150" class="center" /></td>
                <td class="text-center">Php {{ $product->price }}</td>
                <td class="text-center">
                    <form action="{{route('destroy', $product->id)}}" method="POST">

                        <a class="btn btn-info" href="{{route('items.show',$product->id)}}">Show</a>
                        <a class="btn btn-primary" href="{{route('items.edit',$product->id)}}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger"> Delete </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {!! $products->previousPageUrl() ? '<a href="' . $products->previousPageUrl() . '" class="btn btn-primary mr-2 pr-2">&lt; Previous</a>' : '' !!}
        {!! $products->nextPageUrl() ? '<a href="' . $products->nextPageUrl() . '" class="btn btn-primary">Next &gt;</a>' : '' !!}
    </div>
@endsection
