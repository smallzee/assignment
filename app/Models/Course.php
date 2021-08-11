<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  use HasFactory;
  public function create($data)
  {
    $save = new self;
    $save->faculty_id = $data['faculty_id'];
    $save->department_id = $data['department_id'] ?? 0;
    $save->level = $data['level'];
    $save->semester = $data['semester'];
    $save->course_title = $data['course_title'];
    $save->course_code = $data['course_code'];
    $save->save();
  }
  public function faculty()
  {
    return $this->belongsTo(Faculties::class, 'faculty_id');
  }
  public function dept()
  {
    return $this->belongsTo(Department::class, 'department_id');
  }
  public function levels()
  {
    return $this->belongsTo(Level::class, 'level');
  }
  public function level_get()
  {
    return $this->belongsTo(Level::class, 'level');
  }
  public function semester_get()
  {
    return $this->belongsTo(Semester::class, 'semester');
  }
}
