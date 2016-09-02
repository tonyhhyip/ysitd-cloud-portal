<?php

namespace App\Http\Controllers;

use App\Http\Requests\Issue\CreateRequest;
use App\Models\Issue;
use App\Models\IssueComment;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index(Request $request)
    {
        $offset = intval($request->input('start', 0));
        $issues = Issue::select(['id', 'title'])
            ->offset(is_int($offset) ? $offset : 0)
            ->take(10)
            ->get();
        return view('issue/index', ['title' => 'Issue', 'issues' => $issues]);
    }

    public function create()
    {
        return view('issue/create', ['title' => 'Report Issue']);
    }

    public function store(CreateRequest $request, Guard $auth)
    {
        $data = [
            'owner' => $auth->user()->user_id,
            'detail' => $request->input('detail'),
            'category' => $request->input('issue_type'),
            'service' => $request->input('service'),
            'title' => $request->input('title')
        ];

        Issue::create($data);
        return redirect()->route('issue.index');
    }

    public function show($issue, Request $request)
    {
        try {
            $issue = Issue::findOrFail($issue);
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json($issue->attributesToArray());
            } else {
                return view('issue/show', ['title' => 'View Issue', 'issue' => $issue]);
            }
        } catch (ModelNotFoundException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Not exists']);
            } else {
                return redirect()->route('issue.index');
            }
        }
    }

    public function listComment($issue)
    {
        $issue = intval($issue);
        $comments = IssueComment::where('issue', $issue)
            ->join('users', 'users.user_id', '=', 'issue_comments.user')
            ->orderBy('created_at')
            ->get(['user', 'display_name', 'content', 'issue_comments.created_at']);
        return response()->json(['comments' => $comments]);
    }
}