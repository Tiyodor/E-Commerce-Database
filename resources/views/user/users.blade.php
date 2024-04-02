@extends('app')

@section('content')
    <div class="item-table roll-in">
        <div class="navbar">
            <div class="navbar-nav">
                <h2>User Management</h2>
            </div>
            <div class="navbar-nav">
                <a class="general-btn" href="create_user">Manual Add user</a>
            </div>
        </div>


        @if ($message = Session::get('success'))
    <div id="popup" class="alert alert-success">
        <p class="text-white">{{$message}}</p>
    </div>
    <script>
        // Automatically close the popup after 1 second
        setTimeout(function(){
            var popup = document.getElementById('popup');
            popup.style.display = 'none';
        }, 1000);
    </script>
@endif


    <table class="user-table">
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
                {{-- <td class="text-center">{{ $user->id }}</td> --}}
                <td class="text-center">{{ $user->name }}</td>
                <td class="text-center">{{ $user->address }}</td>
                <td class="text-center">{{ $user->email }}</td>
                <td class="text-center">
                    <form action="{{route('destroy_user', $user->id)}}" method="POST">
                        <a class="btn" href="{{route('user.show_user',$user->id)}}">Show</a>
                        <a class="btn" href="{{route('user.edit_user',$user->id)}}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Remove</button>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>



    <div class="pagination">
        {!! $users->previousPageUrl() ? '<a href="' . $users->previousPageUrl() . '" class="btn-page">&lt; Previous</a>' : '' !!}
        {!! $users->nextPageUrl() ? '<a href="' . $users->nextPageUrl() . '" class="btn-page">Next &gt;</a>' : '' !!}
    </div>
        </div>
@endsection
