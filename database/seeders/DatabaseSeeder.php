<?php

namespace Database\Seeders;

use App\Enums\ModelStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\ExamCategory;
use App\Models\ExamChapter;
use App\Models\User;
use App\Models\ExamType;
use App\Models\ExamSubject;
use App\Models\ExamDifficulty;
use App\Models\ExamPattern;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        $examTypes = [
            [
                'name' => 'JEE Advanced',
                'patterns' => [
                    ['name' => 'ADV-2021 P1',],
                    ['name' => 'ADV-2021 P2',],
                    ['name' => 'ADV-2020 P1',],
                    ['name' => 'ADV-2020 P2',],
                    ['name' => 'ADV-2019 P1',],
                    ['name' => 'ADV-2019 P2',],
                    ['name' => 'ADV-2018 P1',],
                    ['name' => 'ADV-2018 P2',],
                    ['name' => 'ADV-2017 P1',],
                    ['name' => 'ADV-2017 P2',],
                ],
            ],
            [
                'name' => 'JEE Main',
                'patterns' => [
                    ['name' => 'MAIN 2022',],
                    ['name' => 'MAIN 2021',],
                    ['name' => 'MAIN 2020',],
                    ['name' => 'MAIN 2019',],
                ],
            ],
            [
                'name' => 'NEET',
                'patterns' => [
                    ['name' => 'NEET 2021',],
                    ['name' => 'NEET 2020',],
                ],
            ],
            [
                'name' => 'State Level Entrances',
                'patterns' => [
                    ['name' => 'KCET',],
                    ['name' => 'MHT CET',],
                    ['name' => 'EAMCET',],
                ],
            ],
        ];

        foreach ($examTypes as $__examType) {
            $examType = ExamType::factory()->create([
                'name' => $__examType['name'],
                'status' => ModelStatusEnum::PUBLISHED,
            ]);
            if (!empty($__examType['patterns'])) {
                foreach ($__examType['patterns'] as $__examPattern) {
                    $examPattern = ExamPattern::factory()->create([
                        'name' => $__examPattern['name'],
                        'exam_type_id' => $examType['id'],
                        'status' => ModelStatusEnum::PUBLISHED,
                    ]);
                }
            }
        }


        $examCategories = [
            ['name'=> 'Exam'],
            ['name'=> 'DPP'],
        ];
        foreach ($examCategories as $examCategory) {
            ExamCategory::factory()->create([
                'name' => $examCategory['name'],
                'status' => ModelStatusEnum::PUBLISHED,
            ]);
        }


        $examSubjects = [
            [
                'name' => 'Physics',
                'chapters' => [
                    ['name' => '01. Mathematics for Physics',],
                    ['name' => '02. Units, Dimensions & Error Analysis',],
                    ['name' => '03. Kinematics',],
                    ['name' => '04. Newton\'s laws of motion',],
                    ['name' => '05. Friction',],
                    ['name' => '06. Circular Motion',],
                    ['name' => '07. Work, Power & Energy',],
                    ['name' => '08. Center of Mass and Conservation of Linear Momentum',],
                    ['name' => '09. Rotational Dynamics',],
                    ['name' => '10. Gravitation',],
                    ['name' => '11. Fluids',],
                    ['name' => '12. Simple Harmonic Motion',],
                    ['name' => '13. Mechanical Properties of Matter',],
                    ['name' => '14. Wave Motion',],
                    ['name' => '15. Thermal Expansion and Calorimetry',],
                    ['name' => '16. Heat Transfer',],
                    ['name' => '17. Kinetic Theory of Gases',],
                    ['name' => '18. Thermodynamics',],
                    ['name' => '19. Electrostatistics',],
                ],
            ],
            [
                'name' => 'Chemistry'
            ],
            [
                'name' => 'Mathematics'
            ],
            [
                'name' => 'Zoology'
            ],
            [
                'name' => 'Botany'
            ],
        ];
        foreach ($examSubjects as $__examSubject) {
            $examSubject = ExamSubject::factory()->create([
                'name' => $__examSubject['name'],
                'status' => ModelStatusEnum::PUBLISHED,
            ]);
            if (!empty($__examSubject['chapters'])) {
                foreach ($__examSubject['chapters'] as $__examChapter) {
                    $examChapter = ExamChapter::factory()->create([
                        'name' => $__examChapter['name'],
                        'exam_subject_id' => $examSubject['id'],
                        'status' => ModelStatusEnum::PUBLISHED,
                    ]);
                }
            }
        }


        $examDifficulties = [
            ['name' => 'Easy'],
            ['name' => 'Moderate'],
            ['name' => 'Tough'],
        ];
        foreach ($examDifficulties as $examDifficulty) {
            ExamDifficulty::factory()->create([
                'name' => $examDifficulty['name'],
                'status' => ModelStatusEnum::PUBLISHED,
            ]);
        }

        User::factory()->withPersonalTeam()->create([
            'name' => 'Admin',
            'lastname' => 'User',
            'username' => 'admin',
            'role' => UserRoleEnum::SUPERADMIN,
            'email' => 'admin@test.com',
            'phone' => '8181040977',
        ]);
        User::factory()->create([
            'name' => 'Editor',
            'lastname' => 'User',
            'username' => 'editor',
            'role' => UserRoleEnum::EDITOR,
            'email' => 'editor@test.com',
            'phone' => '9123456789',
        ]);
    }
}
