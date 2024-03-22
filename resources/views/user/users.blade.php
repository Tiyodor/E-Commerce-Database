@extends('app')

@section('content')
    <div class="item-table">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User Management</h2>
            </div>
            <div class="pull-right" style="margin-bottom:10px;">
                <a class="btn btn-success" href="/user/create_user">Manual add user</a>
            </div>
        </div>
    </div>


        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        @endif

    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td class="text-center">{{ $user->name }}</td>
                <td class="text-center">{{ $user->address }}</td>
                <td class="text-center">{{ $user->email }}</td>
                <td class="text-center">
                    <form action="{{route('destroy_user', $user->id)}}" method="POST">
                        <a class="btn btn-info" href="{{route('user.show_user',$user->id)}}">Show</a>
                        <a class="btn btn-primary" href="{{route('user.edit_user',$user->id)}}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {!! $users->previousPageUrl() ? '<a href="' . $users->previousPageUrl() . '" class="btn btn-primary mr-2 pr-2">&lt; Previous</a>' : '' !!}
        {!! $users->nextPageUrl() ? '<a href="' . $users->nextPageUrl() . '" class="btn btn-primary">Next &gt;</a>' : '' !!}
    </div>
        </div>
@endsection
