@extends('app')

@section('content')
<div class="form-container">
    <div class="navbar">
      <div class="navbar-nav">
          <h2> Edit user details</h2>
      </div>
      <div class="navbar-nav">
          <a class="general-btn" href="{{url('user/users')}}"> Back </a>
      </div>
  </div>


<form action="{{ route('update_user' ,$user->id)}}" method="POST" enctype="multipart/form-data">
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
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{$user->name}}" style="height:50px" class="form-input" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                <input class="form-input" style="height:50px" name="address" value="{{$user->address}}" placeholder="Address"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input class="form-input" style="height:50px" name="email" value="{{$user->email}}" placeholder="Email"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input class="form-input" style="height:50px" name="password" value="{{$user->password}}" placeholder="Password"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
</form>
</div>
@endsection
