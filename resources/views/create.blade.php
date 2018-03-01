@extends('layouts.app')

@section('content')
    <div class="container">
        <span><a href="{{ route('users.index') }}"> Users</a></span> &gt; <span>Create new user</span>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{ Form::open(array('url' => url('/users'), 'method' => 'POST')) }}
                <div class="form-group">
                    <label for="name">
                        Name:
                    </label>
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}"
                           placeholder="Your name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">
                        Email:
                    </label>
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'has-error' : '' }}"
                           placeholder="Your email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="passsword">
                        Password:
                    </label>
                    <input type="password" name="password"
                           class="form-control {{ $errors->has('password') ? 'has-error' : '' }}">
                </div>
                <div class="form-group">
                    <label for="confirmation_passsword">
                        Confirmation Password:
                    </label>
                    <input type="password" name="password_confirmation"
                           class="form-control {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                </div>
                <div>
                    <button class="btn btn-primary col-md-2" type="submit">Save</button>
                    <button class="btn btn-danger col-md-2" type="reset">Reset</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
