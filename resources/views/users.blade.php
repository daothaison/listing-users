@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> User was created successfully!
            </div>
        @endif
        @if (session('update'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> User was updated successfully!
            </div>
        @endif
        @if (session('delete'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> User was deleted successfully!
            </div>
        @endif
        <div class="row justify-content-center">
            @foreach($users as $index => $user)
                <div class="col-md-4 card">
                    <img src="https://www.mautic.org/media/images/default_avatar.png" alt="/Avatar" style="width:100%">
                    <div class="button btn-group-sm">
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}">
                            <button type="button" class="btn btn-primary">Edit</button>
                        </a>
                        {{ Form::open(array('url' => route('users.destroy', ['user' => $user->id]), 'method' => 'DELETE')) }}
                            <button class="btn btn-danger"> Delete </button>
                        {{ Form::close() }}
                    </div>
                    <h3>{{ $user->name }}</h3>
                    <p class="title">Email: {{ $user->email }}</p>
                    <p>Join date: {{ $user->created_at }}</p>
                    <p><button>Contact</button></p>
                </div>
            @endforeach
        </div>
        {{ $users->links() }}
    </div>
    <div id="btn-create">
        <a href="{{ url('/users/create') }}"><button class="create">Create new user</button></a>
    </div>
@endsection
