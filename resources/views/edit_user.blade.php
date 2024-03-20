@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
      <div class="pull-left">
          <h2> Edit user details</h2>
      </div>
      <div class="pull-right">
          <a class="btn btn-primary" href="{{url('users')}}"> Back </a>
      </div>
  </div>
</div>

<form action="{{ route('update_user' ,$user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{$user->name}}" style="height:50px" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                <input class="form-control" style="height:50px" name="address" value="{{$user->address}}" placeholder="Address"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input class="form-control" style="height:50px" name="email" value="{{$user->email}}" placeholder="Email"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input class="form-control" style="height:50px" name="password" value="{{$user->password}}" placeholder="Password"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
</form>
@endsection
