@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
      <div class="pull-left">
          <h2> Edit product details</h2>
      </div>
      <div class="pull-right">
          <a class="btn btn-primary" href="{{url('/')}}"> Back </a>
      </div>
  </div>
</div>

<form action="{{ route('update' ,$product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name: </strong>
                <input type="text" name="name" value="{{ $product->name}}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details: </strong>
                <input type="text" name="details" value="{{ $product->details}}" class="form-control" placeholder="Details">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category: </strong>
                <input type="text" name="category" value="{{ $product->category}}" class="form-control" placeholder="Category">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price: </strong>
                <input type="text" name="price" value="{{ $product->price}}" class="form-control" placeholder="Price ">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image: </strong>
                <input type="file" name="product_image" class="form-control" placeholder="Image">
                <img src="/images/{{ $product->product_image }}" width="500px">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
</form>
@endsection
