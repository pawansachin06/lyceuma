<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class QuestionsImport implements ToCollection
{

    protected $tableName;
    protected $chapters;
    protected $courses;
    protected $difficulties;

    public function __construct($tableName, $chapters, $courses, $difficulties)
    {
        $this->tableName = $tableName;
        $this->chapters = $chapters;
        $this->courses = $courses;
        $this->difficulties = $difficulties;
    }

    public function collection(Collection $collection)
    {
        $table = $this->tableName;
        $courses = $this->courses;
        $chapters = $this->chapters;
        $difficulties = $this->difficulties;
        foreach ($collection as $key => $row) {
            if($key == 0) continue;
            $chapter_id = (!empty($row[12]) && !empty($chapters[$row[12]])) ? $chapters[$row[12]] : '';
            $topic_id = (!empty($row[13]) && !empty($chapters[$row[13]])) ? $chapters[$row[13]] : '';
            $course_id = (!empty($row[14]) && !empty($courses[$row[14]])) ? $courses[$row[14]] : '';
            $difficulty_id = (!empty($row[15]) && !empty($difficulties[$row[15]])) ? $difficulties[$row[15]] : '';
            $input = [
                'question' => $row[1],
                'option1' => $row[2],
                'option2' => $row[3],
                'option3' => $row[4],
                'option4' => $row[5],
                'option5' => $row[6],
                'answer' => $row[7],
                'solution' => $row[8],
                'positive_marks' => $row[9],
                'negative_marks' => $row[10],
                'answer_type' => strtoupper($row[11]),
                'chapter_id' => $chapter_id,
                'topic_id' => $topic_id,
                'course_id' => $course_id,
                'difficulty_id' => $difficulty_id,
            ];
            // Log::info($input);
            if(!empty($row[1]) && $row[2]){
                DB::table($table)->insert($input);
            }
        }
    }
}
