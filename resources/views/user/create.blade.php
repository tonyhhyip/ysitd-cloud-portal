@extends('layouts/default/template')

@section('content')
    <div class="row">
        <form action="{{ route('account.user.store') }}" method="post" class="col s12">
            <div class="row">
                {{ csrf_field() }}
                <div data-form-element data-form="user.create"></div>
            </div>
            <div>
                <button class="btn waves-light waves-effect" type="submit">
                    Submit
                </button>
                <button class="btn waves-light waves-effect" type="reset">
                    Reset
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {!! $scripts->provide('app') !!}
@endsection