@extends('app')

@section('content')
    <div class="reg-container">
        <div class="">
            <div class="">
                <div class="">
                    <div class="header">{{ __('Register Admin') }}</div>

                    <div class="">
                        <form method="POST" action="{{ route('admin.register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="form-label">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username" class="form-label">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-input @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-input" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="login-buttons">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
