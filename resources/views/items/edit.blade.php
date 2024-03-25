@extends('app')

@section('content')
<div class="edit-container">
    <div class="navbar">
      <div class="navbar-nav">
          <h2> Edit product details</h2>
      </div>
      <div class="navbar-nav">
          <a class="general-btn" href="{{url('/items/index')}}"> Back </a>
      </div>
  </div>


<form action="{{ route('update' ,$product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @if($errors->any())
        {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
    @endif

    <div class="row">
        <div class="form-group">
            <div class="forms-label">
                <strong>Name: </strong>
                <input type="text" name="name" value="{{ $product->name}}" class="form-input" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <div class="forms-label">
                <strong>Details: </strong>
                <input type="text" name="details" value="{{ $product->details}}" class="form-input" placeholder="Details">
            </div>
        </div>
        <div class="form-group">
            <div class="forms-label">
                <strong>Category: </strong>
                <input type="text" name="category" value="{{ $product->category}}" class="form-input" placeholder="Category">
            </div>
        </div>
        <div class="form-group">
            <div class="forms-label">
                <strong>Price: </strong>
                <input type="text" name="price" value="{{ $product->price}}" class="form-input" placeholder="Price ">
            </div>
        </div>
        <div class="form-group">
            <div class="forms-label">
                <strong>Image: </strong>
                <input type="file" name="product_image" class="form-input" placeholder="Image" style="width: 500px">
                <img src="/images/{{ $product->product_image }}" width="300px">
            </div>
        </div>
        <div class="form-group text-center" >
            <button type="submit" class="btn">Submit</button>
    </div>
    </div>
</form>
</div>
@endsection
