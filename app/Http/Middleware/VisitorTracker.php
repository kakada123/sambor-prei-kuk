<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;

class VisitorTracker
{
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $visitor = Visitor::where('ip', $ip)->first();

        if ($visitor) {
            $visitor->last_visit = now();
            $visitor->save();
        } else {
            Visitor::create(['ip' => $ip, 'last_visit' => now()]);
        }

        return $next($request);
    }
}
