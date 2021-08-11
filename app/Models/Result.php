<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
    ];

    public function create($data, $id)
    {
        $save = new self;
        $save->student_id = $id;
        $save->class_id = $data['class_id'];
        $save->subject_id = $data['subject_id'];
        $save->save();
    }

    public function update_now($data, $id)
    {
        $save = new self;
        $save->student_id = $id;
        $save->class_id = $data[0]['class_id'];
        $save->subject_id = $data[0]['subject_id'];
        $save->save();
    }
}
