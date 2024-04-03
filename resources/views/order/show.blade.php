@extends('app')

@section('content')
    <div class="form-container">
      <div class="navbar">
        <div class="navbar-nav">
            <h2> Order details </h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{url('/order/orders')}}"> Back </a>
        </div>
    </div>


<div class="rows">
    <div class="form-group">
        <div class="forms-label">
            <strong>Name: </strong>
            {{$order->name}}
        </div>
    </div>
    <div class="form-group">
        <div class="forms-label">
            <strong>Items: </strong>
            @foreach ($order->products as $product)
            {{ $product->name }} <br>
        @endforeach
        </div>
    </div>
    <div class="form-group">
        <div class="forms-label">
            <strong>Address: </strong>
            {{$order->address}}
        </div>
    </div>
    <div class="form-group">
        <div class="forms-label">
            <strong class="" id="total_{{ $order->id }}">Total: </strong>
            Php {{ $order->total }}
        </div>
    </div>
    <div class="form-group">
        <div class="forms-label">
            <strong>Mode of payment: </strong>
            {{$order->payment }}
        </div>
    </div>
    <div class="form-group">
        <div class="forms-label">
            <strong>Mode of Delivery: </strong>
            {{$order->mod}}
        </div>
    </div>
    <div class="form-group">
        <div class="forms-label">
            <strong>status: </strong>
            {{$order->status}}
        </div>
    </div>
</div>

{{-- <script>

    // Calculate and display total price for each order
    @foreach ($orders as $order)
        var total_{{ $order->id }} = 0;
        @foreach ($order->products as $product)
            total_{{ $order->id }} += parseFloat("{{ $product->price }}");
        @endforeach
        document.getElementById('total_{{ $order->id }}').innerHTML = 'Php ' + total_{{ $order->id }}.toFixed(2);
    @endforeach

</script> --}}
@endsection
