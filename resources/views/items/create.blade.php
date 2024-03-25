@extends('app')

@section('content')
<div class="form-container">
    <div>
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Add New Product</h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{ url('/items/index') }}"> Back</a>
        </div>
    </div>


@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('items.product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

     <div class="row">
        <div class="form-groups">
            <div class="forms-label">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-input" placeholder="Name">
            </div>
        </div>
        <div class="form-groups">
            <div class="forms-label">
                <strong>Detail:</strong>
                <textarea class="form-input" style="height:50px" name="details" placeholder="Details"></textarea>
            </div>
        </div>
        <div class="form-groups">
            <div class="forms-label">
                <strong>Category:</strong>
                 <select  name="category" class="form-input">
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
        <div class="form-groups">
            <div class="forms-label">
                <strong>Image:</strong>
                <input type="file" name="product_image" class="form-input" placeholder="image">
            </div>
        </div>
        <div class="form-groups">
            <div class="forms-label">
                <strong>Price:</strong>
                <textarea class="form-input" style="height:50px" name="price" placeholder="Price"></textarea>
            </div>
        </div>
        <div class="form-groups text-center">
                <button type="submit" class="btn">Submit</button>
        </div>
    </div>

</form>
</div>
</div>
@endsection

