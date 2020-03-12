<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\User;
use Closure;
use Validator;


class ProfileValidator
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('post') | $request->isMethod('put')) {
          Validator::validate($request->toArray(), User::rules(), [], User::attributeNames());
        }
        return $next($request);
    }
}
