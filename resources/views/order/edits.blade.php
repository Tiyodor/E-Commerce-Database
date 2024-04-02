@extends('app')

@section('content')
<div class="edit-container">
    <div class="navbar">
      <div class="navbar-nav">
          <h2> Edit order details</h2>
      </div>
      <div class="navbar-nav">
          <a class="general-btn" href="{{url('/order/orders')}}"> Back </a>
      </div>
  </div>


<form action="{{ route('order.update' ,$order->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @if ($errors->any())
    <script>
        window.onload = function() {
            var errorMessage = 'Whoops! There were some problems with your input.';
            @foreach ($errors->all() as $error)
                errorMessage += '{{ $error }}';
            @endforeach
            errorMessage += '';
            alert(errorMessage);
        }
    </script>
    @endif

    <div class="row">
        <div class="form-groups">
            <div class="forms-label">
                <strong>Name:</strong>
                @foreach ($order->products as $product)
                        {{ $order->name }} <br>
                    @endforeach
            </div>
        </div>
        <div class="form-groups">
            <div class="forms-label">
                <strong>Items:</strong>
                @foreach ($order->products as $product)
                        {{ $product->name }} <br>
                    @endforeach
            </div>
        </div>
        <div class="form-groups">
            <div class="forms-label">
                <strong >Total: Php</strong>
                <div  id="total_{{ $order->id }}"  style="height:50px">  {{ $order->total }}</</div>
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

        <div class="form-groups">
            <div class="forms-label">
                <strong>Status:</strong>
                 <select  name="status" class="form-input">
                    <option value="processing">Processing</option>
                    <option value="Ofd">Out for Delivery</option>
                    <option value="Delivered">Delivered</option>
                  </select>
            </div>
        </div>
        <div class="form-group text-center" >
            <button type="submit" class="btn" >Submit</button>
            <button type="cancel" class="btn-cancel">Cancel Order</button>
        </div>

    </div>
</form>
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
