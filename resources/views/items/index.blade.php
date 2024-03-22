@extends('app')

@section('content')
<div class="item-table">
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

    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th>Category</th>
            <th>Product Image</th>
           <th>Price</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
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

                        <a class="btn" href="{{route('items.show',$product->id)}}">Show</a>
                        <a class="btn" href="{{route('items.edit',$product->id)}}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn"> Delete </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="btn">
        {!! $products->previousPageUrl() ? '<a href="' . $products->previousPageUrl() . '" >&lt; Previous</a>' : '' !!}
        {!! $products->nextPageUrl() ? '<a href="' . $products->nextPageUrl() . '" >Next &gt;</a>' : '' !!}
    </div>
        </div>
@endsection
