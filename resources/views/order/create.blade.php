@extends('app')

@section('content')
<div class="form-container">

    <div class="navbar">
        <div class="navbar-nav">
            <h2>Create Order</h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{ url('/order/orders') }}"> Back</a>
        </div>
    </div>

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

    <form id="order-form" action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="left-side">
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
                        <select id="product" name="product[]" class="form-input" multiple>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} | {{ $product->category }} | {{ $product->price }} | {{ $product->quantity }} | {{ $product->availability }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-groups">
                    <div class="forms-label">
                        <div id="total" style="height:50px"></div>
                    </div>
                </div>
            </div>

            <div class="right-side">
                <div class="form-groups">
                    <div class="forms-label">
                        <strong>Payment Method:</strong>
                        <select name="payment" class="form-input">
                            <option value="COD">Cash on Delivery</option>
                            <option value="Bank">Bpi, Bpo, Metrobank, Etc</option>
                            <option value="Gcash">Gcash</option>
                        </select>
                    </div>
                </div>

                <div class="form-groups">
                    <div class="forms-label">
                        <strong>Mode of Delivery:</strong>
                        <select name="mod" class="form-input">
                            <option value="J&T">J&T</option>
                            <option value="Lalamove">Lalamove</option>
                            <option value="Shopee">Shopee</option>
                        </select>
                    </div>
                </div>

                <!-- Removed Status form field -->

                <div class="form-groups text-center">
                    <button type="submit" class="btn">Submit</button>
                </div>

            </div>


        </div>
    </form>

</div>

<script>
    document.getElementById('product').addEventListener('change', function() {
        var selectedProducts = this.selectedOptions;
        var totalPrice = 0;
        for (var i = 0; i < selectedProducts.length; i++) {
            var price = parseFloat(selectedProducts[i].getAttribute('data-price'));
            totalPrice += price;
        }
        document.getElementById('total').innerHTML = '<strong>Total: Php ' + totalPrice.toFixed(2) + '</strong>';
    });
</script>

@endsection
