@extends('layouts/default/template')

@section('content')
    <div class="row">
        <div class="col s24 m12">
            <md-card>
                <span slot="title">
                    <user-icon size="medium" user="{{ $issue->user->user_id }}" type="inline"></user-icon>
                    #{{ $issue->id  }}
                    {{ $issue->title }}
                    <small class="text-gray">
                            {{ $issue->user->display_name }}
                    </small>
                </span>
                <div>
                    {{ $issue->detail }}
                </div>
            </md-card>
            <issue-comments id="{{ $issue->id }}"></issue-comments>
            <comment-field url="{{ route('issue.comment.post', ['issue' => $issue->id]) }}" token="{{ csrf_token() }}"></comment-field>
        </div>
    </div>
@endsection

@section('scripts')
    {!! $scripts->provide('issue') !!}
@endsection