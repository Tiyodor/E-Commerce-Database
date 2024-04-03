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

<form id="addProductForm" action="{{ route('items.product.store') }}" method="POST" enctype="multipart/form-data">
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
                <strong>Detail:</strong>
                <input class="form-input" style="height:50px" name="details" placeholder="Details"></input>
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
        </div>

        <div class="right-side">
        <div class="form-groups">
            <div class="forms-label">
                <strong>availability:</strong>
                 <select  name="availability" class="form-input">
                    <option value="Pre-order">Pre-order</option>
                    <option value="Available">Available</option>
                  </select>
                </div>

            <div class="forms-label">
                <strong>Quantity:</strong>
                <input class="form-input" style="height:50px" name="quantity" type="number" placeholder="Quantity"></input>
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
                <input class="form-input" style="height:50px" name="price" type="number" placeholder="Price"></input>
            </div>
        </div>

        <div class="form-groups text-center">
                <button type="button" id="submitButton" class="btn">Submit</button>
        </div>
    </div>
    </div>

</form>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    document.getElementById("submitButton").addEventListener("click", function() {
        var name = document.getElementsByName("name")[0].value.trim();
        var details = document.getElementsByName("details")[0].value.trim();
        var quantity = document.getElementsByName("quantity")[0].value.trim();
        var price = document.getElementsByName("price")[0].value.trim();

        if (name === '' || details === '' || quantity === '' || price === '') {
            Swal.fire({
                title: "Invalid Input",
                text: "Please fill out all required fields.",
                icon: "error"
            });
            return;
        }


        Swal.fire({
            title: "Are you sure?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes, submit it!",
            cancelButtonText: "No, cancel it"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("addProductForm").submit();
            }
        });
    });
</script>


@endsection
