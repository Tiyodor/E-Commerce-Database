@extends('app')

@section('content')
<div class="form-container">
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Add New User</h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{ url('/user/users') }}"> Back</a>
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

<form action="{{ route('user.store_user') }}" method="POST" enctype="multipart/form-data">
    @csrf

     <div class="row">
        <div class="form-groups">
            <div class="forms-label">
                <strong>Name:</strong>
                <input type="text" name="name" style="height:50px" class="form-input" placeholder="Name">
            </div>
        </div>
        <div class="form-groups">
            <div class="forms-label">
                <strong>Address:</strong>
                <input class="form-input" style="height:50px" name="address" placeholder="Address"></input>
            </div>
        </div>
        <div class="form-groups">
            <div class="forms-label">
                <strong>Email:</strong>
                <input class="form-input" style="height:50px" name="email" placeholder="Email"></input>
            </div>
        </div>
        <div class="form-groups">
            <div class="forms-label">
                <strong>Password:</strong>
                <input class="form-input" style="height:50px" name="password" placeholder="Password"></input>
            </div>
        </div>
        <div class="form-groups text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
</div>
@endsection

