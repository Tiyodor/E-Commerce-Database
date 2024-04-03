@extends('app')

@section('content')
    <div class="edit-container">
      <div class="navbar">
        <div class="navbar-nav">
            <h2> Product details </h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{url('/items/index')}}"> Back </a>
        </div>
    </div>


<div class="rows">
    <div class="left-side">
    <div class="form-group">
        <div class="forms-label">
            <strong>Name: </strong>
            {{$product->name}}
        </div>
    </div>
    <div class="form-group">
        <div class="forms-label">
            <strong>Details: </strong>
            {{$product->details}}
        </div>
    </div>
    <div class="form-group">
        <div class="forms-label">
            <strong>Category: </strong>
            {{$product->category}}
        </div>
    </div>
        <div class="form-group">
            <div class="forms-label">
            <strong>Price: </strong>
            {{$product->price}}
        </div>
    </div>
</div>
    <div class="right-side">

    <div class="form-group">
        <div class="forms-label">
            <strong>Product Image: </strong>
            <br>
            <img src="/images/{{ $product->product_image }}" width="500px">
        </div>
    </div>

</div>
</div>
@endsection
