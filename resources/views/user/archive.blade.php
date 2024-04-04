@extends('app')

@section('content')
<div class="item-table">
    <div class="navbar">
        <div class="navbar-nav">
            <h2>Archives</h2>
        </div>
        <div class="navbar-nav">
            <a class="general-btn" href="{{ route('user.users')}}"> Back </a>
        </div>
    </div>

    <table class="user-table">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th width="280px">Action</th>
        </tr>
        @php $i = 0 @endphp <!-- Define $i here -->

        @foreach ($users as $user)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                {{-- <td class="text-center">{{ $user->id }}</td> --}}
                <td class="text-center">{{ $user->name }}</td>
                <td class="text-center">{{ $user->address }}</td>
                <td class="text-center">{{ $user->email }}</td>
                <td class="text-center">
                    <form id="deleteForm_{{ $user->id }}" action="{{route('user.destroy_user', $user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn" onclick="confirmDelete('{{ $user->id }}')">Delete</button>
                    </form>
                </td>
                <td class="text-center">
                    <form id="restoreForm_{{ $user->id }}" action="{{route('user.restore', $user->id)}}" method="POST">
                        @csrf
                        <button type="button" class="btn" onclick="confirmRestore('{{ $user->id }}')">Restore</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to retrieve this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms, submit the form
                document.getElementById('deleteForm_' + userId).submit();
            }
        });
    }

    function confirmRestore(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This item will be restored!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms, submit the form
                document.getElementById('restoreForm_' + userId).submit();
            }
        });
    }
</script>

@endsection
