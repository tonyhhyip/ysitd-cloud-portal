@extends('layouts/document/template')

@section('title', 'User Register')

@section('content')
    <div class="row">
        <form action="{{ url('/auth/apply') }}" method="post" class="col s12">
            <div class="row">
                {{ csrf_field() }}
                <div data-form-element data-form="user.register"></div>
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