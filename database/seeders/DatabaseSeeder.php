<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\ExamCategory;
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
                    [
                        'name' => 'ADV-2021 P1',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'ADV-2021 P2',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'ADV-2020 P1',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'ADV-2020 P2',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'ADV-2019 P1',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'ADV-2019 P2',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'ADV-2018 P1',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'ADV-2018 P2',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'ADV-2017 P1',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'ADV-2017 P2',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'JEE Main',
                'patterns' => [
                    [
                        'name' => 'MAIN 2022',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'MAIN 2021',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'MAIN 2020',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'MAIN 2019',
                        'categories' => [
                            ['name' => 'Class 11 & 12'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'NEET',
                'patterns' => [
                    [
                        'name' => 'NEET 2021',
                        'categories' => [
                            ['name' => 'Class 11 & 12']
                        ],
                    ],
                    [
                        'name' => 'NEET 2020',
                        'categories' => [
                            ['name' => 'Class 11 & 12']
                        ],
                    ],
                ],
            ],
            [
                'name' => 'State Level Entrances',
                'patterns' => [
                    [
                        'name' => 'KCET',
                        'categories' => [
                            ['name'=> 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'MHT CET',
                        'categories' => [
                            ['name'=> 'Class 11 & 12'],
                        ],
                    ],
                    [
                        'name' => 'EAMCET',
                        'categories' => [
                            ['name'=> 'Class 11 & 12'],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($examTypes as $__examType) {
            $examType = ExamType::factory()->create([
                'name' => $__examType['name'],
            ]);
            if(!empty($__examType['patterns'])){
                foreach ($__examType['patterns'] as $__examPattern) {
                    $examPattern = ExamPattern::factory()->create([
                        'name' => $__examPattern['name'],
                        'exam_type_id' => $examType['id'],
                    ]);
                    if(!empty($__examPattern['categories'])){
                        foreach ($__examPattern['categories'] as $__examCategory) {
                            $examCategory = ExamCategory::factory()->create([
                                'name' => $__examCategory['name'],
                                'exam_pattern_id' => $examPattern['id'],
                            ]);
                        }
                    }
                }
            }
        }

        $examSubjects = [
            ['name'=> 'Physics'],
            ['name'=> 'Chemistry'],
            ['name'=> 'Mathematics'],
            ['name'=> 'Zoology'],
            ['name'=> 'Botany'],
        ];
        foreach ($examSubjects as $examSubject) {
            ExamSubject::factory()->create([
                'name' => $examSubject['name'],
            ]);
        }


        $examDifficulties = [
            ['name'=> 'Easy'],
            ['name'=> 'Moderate'],
            ['name'=> 'Tough'],
        ];
        foreach ($examDifficulties as $examDifficulty) {
            ExamDifficulty::factory()->create([
                'name' => $examDifficulty['name'],
            ]);
        }

        User::factory()->withPersonalTeam()->create([
            'name' => 'Admin',
            'lastname' => 'User',
            'username' => 'admin',
            'role' => UserRoleEnum::SUPERADMIN,
            'email' => 'admin@example.com',
            'phone' => '8181040977',
        ]);
    }
}
