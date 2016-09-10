@extends('layouts/document/template')

@section('content')
    <div class="row">
        <div class="col s12 m6">
            <img src="{{ route('user.icon', ['user' => $theUser->user_id]) }}" class="materialboxed center i300w">
        </div>
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <table>
                        <tr>
                            <td>ID</td>
                            <td>{{ $theUser->user_id }}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ $theUser->display_name }}</td>
                        </tr>
                        <tr>
                            <td>Github Account</td>
                            <td>{{ $theUser->github_username }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $theUser->email }}</td>
                        </tr>
                    </table>
                </div>
                @if($user->root)
                <div class="card-action">
                    <a class="btn" href="{{ route('account.user.edit', ['user' => $theUser->user_id]) }}">
                        Edit
                    </a>
                    <a href="{{ route('account.user.destroy', ['user' => $theUser->user_id]) }}" class="btn">
                        Delete
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col s12 m6">
            <ul class="collection with-header z-depth-1">
                <li class="collection-header"><h4>Role</h4></li>
                @if($theUser->root)
                    <li class="collection-item">
                        <div>
                            Root
                            <a href="#" class="secondary-content">
                                <i class="material-icons material-icons-2x">send</i>
                            </a>
                        </div>
                    </li>
                @endif
                @foreach($theUser->roles as $role)
                    <li class="collection-item">
                        <div>
                            {{ $role->name }}
                            <a href="#" class="secondary-content">
                                <i class="material-icons material-icons-2x">send</i>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Permissions</div>
                    <div>
                        @if($theUser->root)
                            <div class="chip">Super User</div>
                        @endif
                        @foreach($theUser->permissions as $permission)
                            <div class="chip">{{ $permission->name }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection