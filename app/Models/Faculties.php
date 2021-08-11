<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculties extends Model
{
  use HasFactory;
  public function create($data)
  {
    $save = new self;
    $save->name = $data['name'];
    $save->code = $data['code'];
    $save->save();
  }

  public function department()
  {
    return $this->hasOne(Department::class, 'faculty_id');
  }
  public function course()
  {
    return $this->hasOne(Course::class, 'faculty_id');
  }
}
