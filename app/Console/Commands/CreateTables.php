<?php

namespace App\Console\Commands;

use App\Enums\ModelStatusEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create dynamic tables without migration files';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $table_exams = 'exams';
        if(!Schema::hasTable($table_exams)){
            Schema::create($table_exams, function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->uuid('course_id')->nullable();
                $table->uuid('user_id')->nullable();
                $table->string('status')->default(ModelStatusEnum::DRAFT);
                $table->text('chapters')->nullable();
                $table->text('meta')->nullable();
                $table->timestamps();
            });
            $this->info($table_exams .' table created');
        } else {
            $this->error(' '. $table_exams .' table already exist ');
        }


        $table_exam_pivot_classroom = 'exam_pivot_classroom';
        if (!Schema::hasTable($table_exam_pivot_classroom)) {
            Schema::create($table_exam_pivot_classroom, function (Blueprint $table) {
                $table->bigInteger('exam_id');
                $table->uuid('classroom_id');
            });
            $this->info($table_exam_pivot_classroom .' table created');
        } else {
            $this->error(' '. $table_exam_pivot_classroom .' table already exist ');
        }


        $table_exam_pivot_subject = 'exam_pivot_subject';
        if (!Schema::hasTable($table_exam_pivot_subject)) {
            Schema::create($table_exam_pivot_subject, function (Blueprint $table) {
                $table->bigInteger('exam_id');
                $table->uuid('subject_id');
                $table->uuid('difficulty_id');
            });
            $this->info($table_exam_pivot_subject .' table created');
        } else {
            $this->error(' '. $table_exam_pivot_subject .' table already exist ');
        }



        $this->newLine();
        $this->info('Dynamic table creation complete');
    }
}
