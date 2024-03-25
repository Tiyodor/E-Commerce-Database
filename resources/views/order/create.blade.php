@extends('app')

@section('content')
<div class="form-container">
    <div>
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Create Order</h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{ url('/order/orders') }}"> Back</a>
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

<form action="{{ route('order.order.store') }}" method="POST" enctype="multipart/form-data">
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
                <strong>Address:</strong>
                <textarea class="form-input" style="height:50px" name="address" placeholder="Address"></textarea>
            </div>
        </div>
        <div class="form-groups">
            <div class="forms-label">
                <strong>Product:</strong>
                 <select  name="product" class="form-input">
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
                <strong>Payment Method:</strong>
                 <select  name="payment" class="form-input">
                    <option value="COD">Cash on Delivery</option>
                    <option value="Bank">Bpi, Bpo, Metrobank, Etc</option>
                    <option value="Gcash">Gcash</option>
                  </select>
            </div>
        </div>

        <div class="form-groups">
            <div class="forms-label">
                <strong>Mode of Delivery:</strong>
                 <select  name="mod" class="form-input">
                    <option value="J&T">J&T</option>
                    <option value="Lalamove">Lalamove</option>
                    <option value="Shopee">Shopee</option>
                  </select>
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

