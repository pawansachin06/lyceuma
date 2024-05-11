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
                'route' => 'exam-types.index',
                'routes' => ['exam-types.index', 'exam-types.create', 'exam-types.edit'],
                'icon' => 'icons.library-books',
                'title' => 'Exam Types',
                'show' => ($isSuperAdmin || $isAdmin || $isEditor),
            ],
            [
                'route' => 'exam-patterns.index',
                'routes' => ['exam-patterns.index', 'exam-patterns.create', 'exam-patterns.edit'],
                'icon' => 'icons.library-books',
                'title' => 'Exam Patterns',
                'show' => ($isSuperAdmin || $isAdmin || $isEditor),
            ],
            [
                'route' => 'exam-subjects.index',
                'routes' => ['exam-subjects.index', 'exam-subjects.create', 'exam-subjects.edit'],
                'icon' => 'icons.library-books',
                'title' => 'Subjects',
                'show' => ($isSuperAdmin || $isAdmin || $isEditor),
            ],
            [
                'route' => 'exam-chapters.index',
                'routes' => ['exam-chapters.index', 'exam-chapters.create', 'exam-chapters.edit'],
                'icon' => 'icons.library-books',
                'title' => 'Chapters',
                'show' => ($isSuperAdmin || $isAdmin || $isEditor),
            ],
            [
                'route' => 'exam-questions.index',
                'routes' => ['exam-questions.index', 'exam-questions.create', 'exam-questions.edit'],
                'icon' => 'icons.library-books',
                'title' => 'Questions',
                'show' => ($isSuperAdmin || $isAdmin || $isEditor),
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
