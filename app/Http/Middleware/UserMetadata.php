<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserMetadata
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

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (!$request->cookies->has('USER') && $this->auth->check()) {
            $this->attachCookie($response);
        }
        return $response;
    }

    private function attachCookie(Response $response)
    {
        $user = $this->auth->user()->user_id;
        $config = config('session');
        $response->headers->setCookie(
            new Cookie(
                'USER', $user, time() + 60 * $config['lifetime'],
                $config['path'], $config['domain'], $config['secure'], false
            )
        );
    }
}