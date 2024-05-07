<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $navLinks = [
            [
                'route' => 'home',
                'routes' => ['home'],
                'icon' => 'icons.language',
                'title' => 'View Website',
            ],
            [
                'route' => 'dashboard',
                'routes' => ['dashboard'],
                'icon' => 'icons.home',
                'title' => 'Dashboard',
            ],
        ];

        return view('layouts.admin', ['navLinks' => $navLinks]);
    }
}
