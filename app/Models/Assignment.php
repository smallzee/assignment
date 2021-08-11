<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
    public function faculty()
    {
        return $this->belongsTo(Faculties::class, 'faculty_id');
    }
    public function dept()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
