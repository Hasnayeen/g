<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard;

class Home extends Dashboard
{
    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.home';
}
