<?php

namespace App\Http\Middleware;

use App\Models\Project;
use App\Models\Team;
use Closure;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RegisterNavigationItems
{
    public function handle(Request $request, Closure $next): Response
    {
        $panel = Filament::getCurrentPanel();

        /** @var \Illuminate\Database\Eloquent\Collection $projects */
        $projects = auth()->user()->projects();
        /** @var \Illuminate\Database\Eloquent\Collection $teams */
        $teams = auth()->user()->teams;
        $panel->navigationItems(
            collect([])->concat(
                $projects
                    ->transform(
                        fn (Project $project): NavigationItem => NavigationItem::make($project->name)
                            ->group(__('Projects'))
                            ->url(route('filament.app.resources.projects.view', ['record' => $project]))
                            ->isActiveWhen(fn (): bool => Str::startsWith(request()->route()->getName(), 'filament.app.resources.projects'))
                    )
                    ->push(
                        NavigationItem::make(__('+ Create Project'))
                            ->group(__('Projects'))
                            ->url(route('filament.app.resources.projects.create'))
                    )
            )->concat(
                $teams
                    ->transform(
                        fn (Team $team): NavigationItem => NavigationItem::make($team->name)
                            ->group(__('Teams'))
                            ->url(route('filament.app.resources.projects.view', ['record' => $team]))
                            ->isActiveWhen(fn (): bool => Str::startsWith(request()->route()->getName(), 'filament.app.resources.teams'))
                    )
                    ->push(
                        NavigationItem::make(__('+ Create Team'))
                            ->group(__('Teams'))
                            ->url(route('filament.app.resources.teams.create'))
                    )
            )->toArray()
        )
            ->navigationGroups([
                NavigationGroup::make(__('Projects'))
                    ->icon('heroicon-o-rectangle-stack'),
                NavigationGroup::make(__('Teams'))
                    ->icon('heroicon-o-user-group'),
            ]);

        return $next($request);
    }
}
