<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Requests\Request;
use Illuminate\Contracts\Auth\Guard;

class AlphaProcess
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * AlphaProcess constructor.
     *
     * @param Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @param Closure $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->user()->cannot('alpha-access')) {
            abort(501);
        } else {
            $next($request);
        }
    }
}