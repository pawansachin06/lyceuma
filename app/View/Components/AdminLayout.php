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
        $user = auth()->user();
        $isSuperAdmin = (!empty($user) && $user->isSuperAdmin());
        $isAdmin = (!empty($user) && $user->isAdmin());
        $isEditor = (!empty($user) && $user->isEditor());
        $isStudent = (!empty($user) && $user->isStudent());

        $navLinks = [
            [
                'route' => 'home',
                'routes' => ['home'],
                'icon' => 'icons.language',
                'title' => 'View Website',
                'show' => true,
            ],
            [
                'route' => 'dashboard',
                'routes' => ['dashboard'],
                'icon' => 'icons.home',
                'title' => 'Dashboard',
                'show' => true,
            ],
            [
                'route' => 'users.index',
                'routes' => ['users.index', 'users.create', 'users.edit'],
                'icon' => 'icons.account-circle',
                'title' => 'Users',
                'show' => ($isSuperAdmin || $isAdmin),
            ],
            [
                'route' => 'profile.show',
                'routes' => ['profile.show'],
                'icon' => 'icons.person-edit',
                'title' => 'Profile',
                'show' => true,
            ],
        ];

        return view('layouts.admin', ['navLinks' => $navLinks]);
    }
}
