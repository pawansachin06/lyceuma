<?php

namespace App\View\Components;

use App\Models\Chapter;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Subject;
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
        $isTeacher = (!empty($user) && $user->isTeacher());

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
                'route'=> 'exams.create',
                'routes'=> ['exams.create'],
                'icon'=> 'icons.fact-check',
                'title'=> 'Create Exam',
                'show'=> true,
            ],
            [
                'route'=> 'exams.index',
                'routes'=> ['exams.index'],
                'icon'=> 'icons.fact-check',
                'title'=> 'My Exams',
                'show'=> true,
            ],
            [
                'route' => 'users.index',
                'routes' => ['users.index', 'users.create', 'users.edit'],
                'icon' => 'icons.account-circle',
                'title' => 'Users',
                'show' => ($isSuperAdmin || $isAdmin),
            ],
            [
                'route'=> 'questions.create',
                'routes'=> ['questions.create'],
                'icon'=> 'icons.question',
                'title'=> 'Upload Question',
                'show'=> ($isSuperAdmin || $isAdmin || $isEditor),
            ],
            [
                'route'=> 'questions.import',
                'routes'=> ['questions.import'],
                'icon'=> 'icons.question',
                'title'=> 'Bulk Upload Question',
                'show'=> ($isSuperAdmin || $isAdmin || $isEditor),
            ],
            [
                'route'=> 'questions.index',
                'routes'=> ['questions.index'],
                'icon'=> 'icons.stacks',
                'title'=> 'Review Questions',
                'show'=> true,
            ],
            // [
            //     'route' => 'exams.index',
            //     'routes' => ['exams.index', 'exams.edit'],
            //     'icon' => 'icons.stacks',
            //     'title' => 'Manage Exam',
            //     'show' => true,
            // ],
            // [
            //     'route' => 'exams.create',
            //     'routes' => ['exams.create'],
            //     'icon' => 'icons.contract-edit',
            //     'title' => 'Create Exam',
            //     'show' => true,
            // ],
            [
                'route' => 'courses.index',
                'routes' => ['courses.index', 'courses.create', 'courses.edit'],
                'icon' => 'icons.category',
                'title' => 'Courses',
                'show' => $user->can('viewAny', Course::class),
            ],
            // [
            //     'route' => 'exam-patterns.index',
            //     'routes' => ['exam-patterns.index', 'exam-patterns.create', 'exam-patterns.edit'],
            //     'icon' => 'icons.fact-check',
            //     'title' => 'Exam Patterns',
            //     'show' => ($isSuperAdmin || $isAdmin || $isEditor),
            // ],
            // [
            //     'route' => 'exam-categories.index',
            //     'routes' => ['exam-categories.index', 'exam-categories.create', 'exam-categories.edit'],
            //     'icon' => 'icons.today',
            //     'title' => 'Exam Categories',
            //     'show' => ($isSuperAdmin || $isAdmin || $isEditor),
            // ],
            [
                'route' => 'classrooms.index',
                'routes' => ['classrooms.index', 'classrooms.create', 'classrooms.edit'],
                'icon' => 'icons.library-books',
                'title' => 'Classrooms',
                'show' => $user->can('viewAny', Classroom::class),
            ],
            [
                'route' => 'subjects.index',
                'routes' => ['subjects.index', 'subjects.create', 'subjects.edit'],
                'icon' => 'icons.library-books',
                'title' => 'Subjects',
                'show' => $user->can('viewAny', Subject::class),
            ],
            [
                'route' => 'chapters.index',
                'routes' => ['chapters.index', 'chapters.create', 'chapters.edit'],
                'icon' => 'icons.library-books',
                'title' => 'Chapters',
                'show' => $user->can('viewAny', Chapter::class),
            ],
            // [
            //     'route' => 'exam-topics.index',
            //     'routes' => ['exam-topics.index', 'exam-topics.create', 'exam-topics.edit'],
            //     'icon' => 'icons.library-books',
            //     'title' => 'Topics',
            //     'show' => ($isSuperAdmin || $isAdmin || $isEditor),
            // ],
            // [
            //     'route' => 'exam-questions.index',
            //     'routes' => ['exam-questions.index'],
            //     'icon' => 'icons.library-books',
            //     'title' => 'Review Questions',
            //     'show' => ($isSuperAdmin || $isAdmin || $isEditor),
            // ],
            // [
            //     'route' => 'exam-questions.create',
            //     'routes' => ['exam-questions.edit'],
            //     'icon' => 'icons.question',
            //     'title' => 'Questions',
            //     'type' => 'form',
            //     'route' => route('exam-questions.store'),
            //     'show' => ($isSuperAdmin || $isAdmin || $isEditor),
            // ],
            // [
            //     'route' => 'mathjax',
            //     'routes' => ['mathjax'],
            //     'icon' => 'icons.function',
            //     'title'=> 'Try MathJax',
            //     'show' => ($isSuperAdmin || $isAdmin || $isEditor)
            // ],
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
