@extends('layouts/default/error')

@section('title', 'Sign In Required')
@section('content')
    <div class="card-content text-strong">
        <p>
            You have to sign in to continue using.
        </p>
        <div class="card-image">
            <img src="{{ url('images/sitcon-lady.png') }}" style="width: auto;height: 300px;">
        </div>
    </div>
@endsection

@section('action')
    <div class="card-action">
        <a href="{{ route('auth.signin') }}" class="waves-effect waves-light btn">Sign in</a>
        <a href="{{ url('auth/register') }}" class="waves-effect waves-light btn">Register</a>
    </div>
@endsection