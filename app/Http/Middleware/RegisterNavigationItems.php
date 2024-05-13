<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterNavigationItems
{
    public function handle(Request $request, Closure $next): Response
    {
        $panel = Filament::getCurrentPanel();

        $projects = auth()->user()->teamProjects();
        // dd($projects);
        // $panel->navigationItems(
        //     $projects
        // );

        return $next($request);
    }
}
