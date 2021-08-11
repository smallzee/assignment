<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->hasOne(Course::class, 'level');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'faculty_id');
    }
}
