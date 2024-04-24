@extends('app')

@section('content')
    <div class="form-container">
        <div class="navbar">
            <div class="navbar-nav">
                <h2>Order details</h2>
            </div>
            <div class="navbar-nav">
                <a class="general-btn" href="{{ url('/checkout/checkouts') }}">Back</a>
            </div>
        </div>

        <div class="rows">
            <div class="left-side">
                <div class="form-group">
                    <div class="forms-label">
                        <strong>Email:</strong>
                        {{ $checkout->email }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="forms-label">
                        <strong>Name:</strong>
                        {{ $checkout->fname }} {{ $checkout->lname }}
                    </div>
                </div>


                <div class="form-group">
                    <div class="forms-label">
                        <strong>Items:</strong>
                        @foreach ($checkout->products as $product)
                            {{ $product->name }} <br>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <div class="forms-label">
                        <strong>Address:</strong>
                        {{ $checkout->address }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="forms-label">
                        <strong>Total:</strong>
                        <span class="total">Php {{ number_format($checkout->total, 2) }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="forms-label">
                        <strong>Mode of payment:</strong>
                        {{ $checkout->payment }}
                    </div>
                </div>


            </div>

            <div class="right-side">
                <div class="form-group">
                    <div class="forms-label">
                        <strong>Product Image:</strong>
                        <br>
                        <div class="imageContainer">
                            @foreach ($checkout->products as $product)
                                <img src="/images/{{ $product->product_image }}" >
                            @endforeach
                        </div>
                    </div>
                </div>
    </div>


@endsection
