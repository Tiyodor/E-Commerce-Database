@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Invetory</h2>
            </div>
            <div class="pull-right" style="margin-bottom:10px;">
                <a class="btn btn-success" href="create">Add new product</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th>Product Image</th>
            <th>Category</th>
            <th witdh="280px">Action</th>
        </tr>

    @foreach ( $products as $product )
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->details}}</td>
        <td><img src="/images/{{ $product->product_image }}" width="150" /></td>
        <td>{{$product->category}}</td>
        <td>
            <form action="" method="POST">

                <a class="btn btn-info" href="">Show</a>
                <a class="btn btn-primary" href="">Edit</a>

        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger"> Delete </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

    {!! $products->links() !!}

    @endsection
