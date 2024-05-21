<?php

namespace Database\Seeders;

use App\Enums\ModelStatusEnum;
use App\Enums\UserRoleEnum;
// use App\Models\ExamCategory;
use App\Models\Chapter;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Difficulty;
// use App\Models\ExamPattern;
use App\Models\QuestionTable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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

        $courses = [
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
                'name' => 'Foundation',
                'patterns' => [
                    ['name' => 'KCET',],
                    ['name' => 'MHT CET',],
                    ['name' => 'EAMCET',],
                ],
            ],
        ];

        foreach ($courses as $__course) {
            $examType = Course::factory()->create([
                'name' => $__course['name'],
                'slug' => Str::slug($__course['name']),
                'status' => ModelStatusEnum::PUBLISHED,
            ]);
            // if (!empty($__examType['patterns'])) {
            //     foreach ($__examType['patterns'] as $__examPattern) {
            //         $examPattern = ExamPattern::factory()->create([
            //             'name' => $__examPattern['name'],
            //             'exam_type_id' => $examType['id'],
            //             'status' => ModelStatusEnum::PUBLISHED,
            //         ]);
            //     }
            // }
        }

        $classrooms = [
            ['name' => 'Class IX', 'order' => 1],
            ['name' => 'Class X', 'order' => 2],
            ['name' => 'Class XI',  'order' => 3],
            ['name' => 'Class XII', 'order' => 4],
        ];
        foreach ($classrooms as $classroom) {
            Classroom::factory()->create([
                'name' => $classroom['name'],
                'slug' => Str::slug($classroom['name']),
                'order'=> $classroom['order'],
                'status' => ModelStatusEnum::PUBLISHED,
            ]);
        }


        // $examCategories = [
        //     ['name' => 'Exam'],
        //     ['name' => 'DPP'],
        // ];
        // foreach ($examCategories as $examCategory) {
        //     ExamCategory::factory()->create([
        //         'name' => $examCategory['name'],
        //         'status' => ModelStatusEnum::PUBLISHED,
        //     ]);
        // }


        $subjects = [
            [
                'name' => 'Physics',
                'chapters' => [
                    [
                        'name' => 'Mathematics for Physics',
                        'topics' => [
                            ['name' => 'Fundamentals of vectors'],
                            ['name' => 'Introductory Trigonometry, Coordinate & Algebra'],
                            ['name' => 'Introductory Differential calculus'],
                            ['name' => 'Application of Differentiation'],
                            ['name' => 'Integration and it\'s Applications '],
                        ],
                    ],
                    [
                        'name' => 'Units, Dimensions & Error Analysis',
                        'topics' => [
                            ['name' => 'Units and Dimensions'],
                            ['name' => 'Dimensional Analysis'],
                            ['name' => 'Error Analysis'],
                            ['name' => 'Signifact Numbers in Measurements'],
                            ['name' => 'Vernier calipers'],
                            ['name' => 'Screw Gauge'],
                        ],
                    ],
                    [
                        'name' => 'Kinematics',
                        'topics' => [
                            ['name' => 'Physical Quantities in Kinematics'],
                            ['name' => 'Relations between time varying Physical Quantities'],
                            ['name' => 'Motion along a Straight line'],
                            ['name' => 'Graphical interpretation of 1-D motion'],
                            ['name' => 'Introductory Projectile Motion'],
                            ['name' => '1-D Relative Motion'],
                            ['name' => '2-D Relative motion: River-Boat, Rain-Main etc'],
                        ],
                    ],
                    [
                        'name' => 'Newton\'s laws of motion',
                        'topics' => [
                            ['name' => 'Free Body Diagrams and Constraint Relations'],
                            ['name' => 'Newton\'s Laws - Basics'],
                            ['name' => 'Application of NLM'],
                            ['name' => 'Non-Inertial Frame of Referance'],
                        ],
                    ],
                    [
                        'name' => 'Friction',
                        'topics' => [
                            ['name' => 'Introductory Frictional Force'],
                            ['name' => 'Single Block problems involving Friction'],
                            ['name' => 'Two Block problems involving Frictional Force'],
                            ['name' => 'Problems with Critical understanding of Frictional Force'],
                        ],
                    ],
                    [
                        'name' => 'Circular Motion',
                        'topics' => [
                            ['name' => 'Introduction to Angular Variables'],
                            ['name' => 'Relation between Angular variables and Linear variables'],
                            ['name' => 'Dynamics of Circular Motion Basics'],
                            ['name' => 'Problems involving Application of Circular Motion'],
                            ['name' => 'Banking of Roads'],
                            ['name' => 'Radius of Curvature'],
                        ],
                    ],
                    ['name' => 'Work, Power & Energy',],
                    ['name' => 'Center of Mass and Conservation of Linear Momentum',],
                    ['name' => 'Rotational Dynamics',],
                    ['name' => 'Gravitation',],
                    ['name' => 'Fluids',],
                    ['name' => 'Simple Harmonic Motion',],
                    ['name' => 'Mechanical Properties of Matter',],
                    ['name' => 'Wave Motion',],
                    ['name' => 'Thermal Expansion and Calorimetry',],
                    ['name' => 'Heat Transfer',],
                    ['name' => 'Kinetic Theory of Gases',],
                    ['name' => 'Thermodynamics',],
                    ['name' => 'Electrostatistics',],
                ],
            ],
            [
                'name' => 'Chemistry',
                'chapters'=> [
                    [
                        'name' => 'Some Basic Concepts of Chemistry (Mole Concept)',
                        'topics' => [
                            ['name'=> 'Measurement of Physical Properties and Composition of Matter'],
                            ['name'=> 'Atoms, Molecules and Laws of combination'],
                            ['name'=> 'Introduction to Mole Concept'],
                            ['name'=> 'Percentage Composition & Empirical Formula'],
                            ['name'=> 'Chemical Equations and Stoichiometry'],
                            ['name'=> 'Solutions and Reactions in Aqueous Medium'],
                        ],
                    ],
                    [
                        'name'=> 'Structure of Atoms',
                        'topics'=> [
                            ['name'=> 'Subatomic Particles & Primitive Models of Atoms'],
                            ['name'=> 'Electromagnetic Waves and Spectra'],
                            ['name'=> 'Bohr\'s Model of Atom'],
                            ['name'=> 'Analysis of Spectra of H-like species'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Mathematics',
                'chapters'=> [
                    [
                        'name'=> 'Basic Maths',
                        'topics'=> [
                            ['name'=> 'Basic Arithmetic & Algebra'],
                            ['name'=> 'Basic Geometry'],
                            ['name'=> 'Intervals and Inequations'],
                            ['name'=> 'Modulus Function'],
                        ],
                    ],
                    [
                        'name'=> 'Logarithms',
                        'topics'=> [
                            ['name'=> 'Fundamentals of Logarithms'],
                            ['name'=> 'Logarithmic Equations'],
                            ['name'=> 'Logarithmic Inequations'],
                            ['name'=> 'Characteristics and Mantissa'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Zoology',
                'chapters'=> [
                    [
                        'name'=> 'Animal Kingdom',
                        'topics'=> [
                            ['name'=> 'Basis of classification and classification'],
                            ['name'=> 'Classification of Non-choradates/Invertebrates'],
                            ['name'=> 'Classification of Phylum Chordata'],
                            ['name'=> 'Subphylum Vertebrata and its Classification'],
                        ],
                    ],
                    [
                        'name'=> 'Structural Organization in Animals',
                        'topics'=> [
                            ['name'=> 'Epithelial Tissue and Cell Junctions'],
                            ['name'=> 'Connective Tissues'],
                            ['name'=> 'Muscular and Neural Tissues, Organs and Organ Systems'],
                            ['name'=> 'Morphology and Anatomy of Frog'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Botany',
                'chapters'=> [
                    [
                        'name'=> 'The Living World',
                        'topics'=> [
                            ['name'=> 'Characteristics of Life and Diversity in Living World'],
                            ['name'=> 'Taxonomic Categories'],
                            ['name'=> 'Taxonomic Aids'],
                        ],
                    ],
                    [
                        'name'=> 'Biological Classification',
                        'topics'=> [
                            ['name'=> 'History of biological classification'],
                            ['name'=> 'Five Kingdom Classification'],
                            ['name'=> 'Viruses, viroids, prions, lichens and mycoplasma'],
                        ],
                    ],
                ],
            ],
        ];
        foreach ($subjects as $__examSubject) {
            $examSubject = Subject::factory()->create([
                'name' => $__examSubject['name'],
                'slug' => Str::slug($__examSubject['name']),
                'status' => ModelStatusEnum::PUBLISHED,
            ]);
            if (!empty($__examSubject['chapters'])) {
                foreach ($__examSubject['chapters'] as $__examChapter) {
                    $examChapter = Chapter::factory()->create([
                        'name' => $__examChapter['name'],
                        'slug' => Str::slug($__examChapter['name']),
                        'subject_id' => $examSubject['id'],
                        'status' => ModelStatusEnum::PUBLISHED,
                    ]);
                    if (!empty($__examChapter['topics'])) {
                        foreach ($__examChapter['topics'] as $__examTopic) {
                            $examSubChapter = Chapter::factory()->create([
                                'name' => $__examTopic['name'],
                                'slug' => Str::slug($__examTopic['name']),
                                'subject_id' => $examSubject['id'],
                                'parent_id' => $examChapter['id'],
                                'status' => ModelStatusEnum::PUBLISHED,
                            ]);
                        }
                    }
                }
            }
        }

        $examDifficulties = [
            ['name' => 'Level 1', 'order' => 1],
            ['name' => 'Level 2', 'order' => 2],
            ['name' => 'Level 3', 'order' => 3],
            ['name' => 'PYQ', 'order' => 4],
        ];
        foreach ($examDifficulties as $examDifficulty) {
            Difficulty::factory()->create([
                'name' => $examDifficulty['name'],
                'slug' => Str::slug($examDifficulty['name']),
                'order' => $examDifficulty['order'],
                'status' => ModelStatusEnum::PUBLISHED,
            ]);
        }

        $newExamClasses = Classroom::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $newExamSubjects = Subject::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);

        foreach ($newExamClasses as $newExamClass) {
            foreach ($newExamSubjects as $newExamSubject) {
                $table_name = 'ques_' . $newExamClass->name . '_' . $newExamSubject->name;
                $table_name = Str::slug($table_name, '_', 'en', ['-' => '_']);
                QuestionTable::factory()->create([
                    'name' => $table_name,
                    'table' => $table_name,
                    'classroom_id' => $newExamClass->id,
                    'subject_id' => $newExamSubject->id,
                ]);

                Schema::create($table_name, function (Blueprint $table) {
                    $table->id();
                    $table->string('name')->nullable();
                    $table->text('question');
                    $table->text('option1')->nullable();
                    $table->text('option2')->nullable();
                    $table->text('option3')->nullable();
                    $table->text('option4')->nullable();
                    $table->text('option5')->nullable();
                    $table->text('option6')->nullable();
                    $table->text('answer')->nullable();
                    $table->text('solution')->nullable();
                    $table->boolean('reviewed')->default(false);
                    $table->decimal('positive_marks', 5, 2)->nullable();
                    $table->decimal('negative_marks', 5, 2)->nullable();
                    $table->string('answer_type')->nullable();
                    $table->uuid('chapter_id')->nullable();
                    $table->uuid('topic_id')->nullable();
                    $table->text('source')->nullable();
                    $table->integer('order')->unsigned()->default(1);
                    $table->string('status')->default(ModelStatusEnum::DRAFT);
                    $table->timestamps();
                });
            }
        }

        User::factory()->withPersonalTeam()->create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'role' => UserRoleEnum::SUPERADMIN,
            'email' => 'admin@test.com',
            'phone' => '8181040977',
        ]);
        User::factory()->withPersonalTeam()->create([
            'name' => 'Admin',
            'username' => 'admin2',
            'role' => UserRoleEnum::ADMIN,
            'email' => 'admin2@test.com',
            'phone' => '9984495055',
        ]);
        User::factory()->create([
            'name' => 'Teacher',
            'username' => 'teacher',
            'role' => UserRoleEnum::TEACHER,
            'email' => 'teacher@test.com',
            'phone' => '9100091002',
        ]);
        User::factory()->create([
            'name' => 'Editor',
            'username' => 'editor',
            'role' => UserRoleEnum::EDITOR,
            'email' => 'editor@test.com',
            'phone' => '9100091005',
        ]);
    }
}
