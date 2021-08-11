<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
  use HasFactory;
  public function create($data)
  {
    $save = new self;
    $save->name = $data['name'];
    $save->faculty_id = $data['faculty_id'];
    $save->save();
  }
  public function faculty()
  {
    return $this->belongsTo(Faculties::class, 'faculty_id');
  }

  public function course()
  {
    return $this->hasOne('App\Models\Course');
  }
}
