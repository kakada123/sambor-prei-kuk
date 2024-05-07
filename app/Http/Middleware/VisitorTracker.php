<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class VisitorTracker
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Generate a base device identifier using User-Agent and Accept-Language
            $userAgent = $request->header('User-Agent');
            $acceptLanguage = $request->header('Accept-Language');
            $baseIdentifier = $userAgent . $acceptLanguage;

            // Append the current date to make the identifier unique per day
            $date = Carbon::now()->format('Y-m-d');
            $deviceIdentifier = md5($baseIdentifier . $date);

            $visitor = Visitor::where('ip', $deviceIdentifier)->first();

            if ($visitor) {
                // Update last visit time for the existing visitor
                $visitor->last_visit = now();
                $visitor->save();
            } else {
                // Create a new visitor record for a different device/browser or a new day
                Visitor::create([
                    'ip' => $deviceIdentifier,
                    'last_visit' => now()
                ]);
            }

            return $next($request);
        } catch (\Throwable $th) {
            Log::error('VisitorTracker error:', ['message' => $th->getMessage(), 'trace' => $th->getTraceAsString()]);
        }

        return $next($request);
    }
}
