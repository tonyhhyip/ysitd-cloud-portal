@extends('layouts/default/template')

@section('content')
    <div class="row">
        <div class="row">
            <a href="#create" class="waves-effect waves-light btn modal-trigger">
                Create new permission
            </a>
            <create-permission></create-permission>
        </div>
        <div class="col s12 m8">
            @if(count($permissions))
                <div class="collection">
                    @foreach($permissions as $permission)
                        <a href="{{ route('account.permission.show', ['permission' => $permission->id]) }}" class="collection-item">
                            {{ $permission->name }}
                        </a>
                    @endforeach
                </div>
            @else
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">
                            No Permission Exists
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    {!! $scripts->provide('permission') !!}
@endsection