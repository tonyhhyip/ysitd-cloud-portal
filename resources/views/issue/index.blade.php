@extends('layouts/default/template')

@section('content')
    <div class="row">
        <div class="row">
            <a class="btn" href="{{ route('issue.create') }}">Report New Issue</a>
        </div>
        <div class="col s12 m9 l10">
            @if(count($issues))
                <div class="collection">
                    @forelse($issues as $issue)
                        <a class="collection-item waves-effect" href="{{ route('issue.show', ['issue' => $issue->id]) }}">
                            <span class="text-gray">#{{$issue->id}}</span>
                            {{ $issue->title }}
                        </a>
                    @endforeach
                </div>
                {!! $issues->render() !!}
            @else
                <div class="card small">
                    <div class="card-content">
                        <span class="card-title">No issue is open.</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection