<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('teacher.login');
    }

    // protected function redirectTo(Request $request): ?string
    // {
    //     // Check if the request is expecting JSON
    //     if ($request->expectsJson()) {
    //         return null; // Return null for JSON requests
    //     }

    //     // Check for specific routes and redirect accordingly
    //     if ($request->is('teacher/*')) {
    //         return route('teacher.login'); // Redirect to 'teacher.login'
    //     }

    //     // Default redirection for other routes
    //     return route('student.login');
    // }
}
