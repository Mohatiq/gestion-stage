<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSociete
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role !== 'societe') {
            abort(403, 'Accès réservé aux sociétés.');
        }
        return $next($request);
    }
}