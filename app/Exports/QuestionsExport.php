<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Database\Query\Builder;

class QuestionsExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    protected $items;
    protected $chapters;
    protected $courses;
    protected $difficulties;

    public function __construct(Builder $items, $chapters, $courses, $difficulties)
    {
        $this->items = $items;
        $this->chapters = $chapters;
        $this->courses = $courses;
        $this->difficulties = $difficulties;
    }

    public function headings(): array
    {
        return [
            'id',
            'question',
            'option1',
            'option2',
            'option3',
            'option4',
            'option5',
            'answer',
            'solution',
            'positive_marks',
            'negative_marks',
            'answer_type',
            'topic_slug',
            'course_slug',
            'difficulty_slug',
        ];
    }

    public function query()
    {
        return $this->items;
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->question,
            $item->option1,
            $item->option2,
            $item->option3,
            $item->option4,
            $item->option5,
            $item->answer,
            $item->solution,
            $item->positive_marks,
            $item->negative_marks,
            strtolower($item->answer_type),
            (!empty($this->chapters[$item->chapter_id]) ? $this->chapters[$item->chapter_id] : '') ,
            (!empty($this->courses[$item->course_id]) ? $this->courses[$item->course_id] : ''),
            (!empty($this->difficulties[$item->difficulty_id]) ? $this->difficulties[$item->difficulty_id] : ''),
        ];
    }
}
