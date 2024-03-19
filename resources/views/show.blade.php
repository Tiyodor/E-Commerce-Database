@extends('app')

@section('content')
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Product details </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{url('/')}}"> Back </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name: </strong>
            {{$product->name}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Details: </strong>
            {{$product->details}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Category: </strong>
            {{$product->category}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Product Image: </strong>
            <img src="/images/{{ $product->product_image }}" width="500px">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Price: </strong>
            {{$product->price}}
        </div>
    </div>
@endsection
