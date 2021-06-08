<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EnableGlobalScopeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Product::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 1);
        });
        return $next($request);
    }
}
