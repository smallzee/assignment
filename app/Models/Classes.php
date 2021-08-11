<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Classes extends Model
{
  use HasFactory;

  protected $table = 'classes';

  public function create($data)
  {
    foreach ($data['subject'] as $subject_id) {
      $save = new self;
      $save->name = $data['name'];
      $save->class_id = Session::get('class_unique');
      $save->subject_id = $subject_id;
      $save->save();
    }

    Session::forget('class_unique');
  }

  public function update_now($data)
  {
    foreach ($data['subject'] as $subject_id) {
      $save = new self;
      $save->name = $data['name'];
      $save->class_id = $data['class_id'];
      $save->subject_id = $subject_id;
      $save->save();
    }

    Session::forget('class_unique');
  }
  public function subject()
  {
    return $this->belongsTo(Subject::class, 'subject_id');
  }
  public function teacher()
  {
    return $this->belongsTo(User::class, 'teacher_id');
  }
}
