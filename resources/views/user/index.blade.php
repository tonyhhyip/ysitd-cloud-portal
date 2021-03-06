@extends('layouts/default/template')

@section('content')
    <div class="row">
        <div class="row">
            <a class="btn" href="{{ route('account.user.create') }}">Create new user</a>
        </div>
        <div class="col s12 m9 l10">
            @if(count($users))
                <div class="collection">
                    @forelse($user<a href="{{ route('account.permission.create') }}" class="btn">Create New Permission</a>s as $user)
                        <a class="collection-item waves-effect" href="{{ route('account.user.show', ['user' => $user->user_id]) }}">
                            {{ $user->display_name }}
                        </a>
                        @endforeach
                </div>
            @else
                <md-card class="small">
                    <span slot="title">No user exists.</span>
                </md-card>
            @endif
        </div>
    </div>
@endsection