<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsApprover
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized access. Please login first.');
        }

        $userRoles = $user->getRoleNames()->toArray();
        $isApproverRole = $user->hasAnyRole(['Admin', 'Sub-Admin', 'Manager', 'Approver']);
        $isInApprovalBand = \App\Models\ApprovalBand::whereIn('role_name', $userRoles)->exists();

        if (!$isApproverRole && !$isInApprovalBand) {
            abort(403, 'Unauthorized access. You do not have approver privileges for any event.');
        }

        return $next($request);
    }
}

