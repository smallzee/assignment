<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public function create($data)
    {
      $save = new self;
      $save->name = $data['name'];
      $save->save();
    }
    
  public function teacher()
  {
    return $this->belongsTo(User::class, 'teacher_id');
  }
}
