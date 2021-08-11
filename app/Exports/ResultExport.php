<?php

namespace App\Exports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')
        ->join('results', 'results.student_id', '=', 'users.email')
        ->where('users.class_id', Session::get('class'))
        ->where('results.subject_id', Auth::user()->class_id)
        ->get(array('users.surname', 'users.last_name', 'users.email', 'results.first_test', 'results.second_test', 'results.exam'));
    }

    public function headings(): array
    {
        return [
            'Student Surname',
            'Student Last Name',
            'Student ID',
            'First Test',
            'Second Test',
            'Exam Score',
        ];
    }
}
