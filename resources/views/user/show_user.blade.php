@extends('app')

@section('content')
    <div class="form-container">
      <div class="navbar">
        <div class="navbar-nav">
            <h2> User details </h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{url('user/users')}}"> Back </a>
        </div>
    </div>

<div class="row">
    <div class="form-group">
        <div class="forms-label">
            <strong>Id: </strong>
            {{$user->id}}
        </div>
    </div>
                    {{-- <td class="text-center">{{ $user->id }}</td> --}}

    <div class="form-group">
        <div class="forms-label">
            <strong>Name: </strong>
            {{$user->name}}
        </div>
    </div>
    <div class="form-group">
        <div class="forms-label">
            <strong>Address: </strong>
            {{$user->address}}
        </div>
    </div>
    <div class="form-group">
        <div class="forms-label">
            <strong>Email: </strong>
            {{$user->email}}
        </div>
    </div>
</div>

@endsection
