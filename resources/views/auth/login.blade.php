@extends('app')

@section('content')

<div class="login-container grow">
    <div class="">
        <div class="">



            <div class="header">Admin Login</div>

            @if ($errors->any())
            <script>
                window.onload = function() {
                    var errorMessage = '';
                    @foreach ($errors->all() as $error)
                        errorMessage += '{{ $error }}';
                    @endforeach
                    errorMessage += '';
                    alert(errorMessage);
                }
            </script>
            @endif

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" type="username" class="login-input" name="username" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="login-input" name="password" required autocomplete="current-password">
                    </div>

                    <div class="login-butt">
                        <button type="submit" class="login-buttons">Login</button>
                        <a href="{{ route('admin.register') }}" class="login-buttons">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{auth()->user()}}
</div>
@endsection
