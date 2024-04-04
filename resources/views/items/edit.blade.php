@extends('app')

@section('content')
<div class="form-container">
    <div class="navbar">
      <div class="navbar-nav">
          <h2> Edit product details</h2>
      </div>
      <div class="navbar-nav">
          <a class="general-btn" href="{{url('/items/index')}}"> Back </a>
      </div>
  </div>


<form action="{{ route('items.update' ,$product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')



<div class="row">

    <div class="left-side">
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

        <div class="form-groups">
            <div class="forms-label">
                <strong>Category:</strong>
                 <select  name="category" class="form-input" >
                    <option value="{{$product->category}}"> {{ $product->category }} </option>
                    <option value="SD">SD</option>
                    <option value="EG">EG</option>
                    <option value="HG">HG</option>
                    <option value="RG">RG</option>
                    <option value="MG">MG</option>
                    <option value="PG">PG</option>
                    <option value="HI-RES">HI-RES</option>
                    <option value="1/100">1/100</option>
                  </select>
            </div>
        </div>

        <div class="form-group">
            <div class="forms-label">
                <strong>Price: </strong>
                <input  name="price" type="number" value="{{ $product->price }}" class="form-input" placeholder="Price ">
            </div>
        </div>
        <div class="form-group">
            <div class="forms-label">
                <strong>Quantity: </strong>
                <input  name="quantity" type="number" value="{{ $product->quantity }}" class="form-input" placeholder="Quantity ">
            </div>
        </div>
        </div>

        <div class="right-side">


        <div class="form-groups">
            <div class="forms-label">
                <strong>availability:</strong>
                 <select  name="availability" class="form-input">
                    <option value="{{$product->availability}}"> {{ $product->availability }} </option>
                    <option value="Pre-order">Pre-order</option>
                    <option value="Available">Available</option>
                  </select>
            </div>
        </div>

        <div class="form-group">
            <div class="forms-label">
                <strong>Image: </strong>
                <input type="file" name="product_image" class="form-input" placeholder="Image" style="width: 500px">

                 <br>
                 <br>
                <img src="/images/{{ $product->product_image }}" width="300px">
            </div>
        </div>

        <div class="form-group text-center" >
            <button type="submit" class="btn">Submit</button>
        </div>
    </div>
    </div>
</form>
</div>
</div>
@endsection
