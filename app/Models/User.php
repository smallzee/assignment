<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'matric_number',
        'email',
        'faculty_id',
        'dept_id',
        'level_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function create($data)
    {
        $id = mt_rand(1000, 9999);
        $pass = strtolower($data['surname']);
        $save = new self;
        $save->email = 'TCH' . $id;
        $save->first_name = $data['first_name'];
        $save->last_name = $data['last_name'];
        $save->class_id = $data['subject_id'];
        $save->role = 'Teacher';
        $save->password = Hash::make($pass);
        $save->save();
        return $save;
    }
    public function create_lecturer($data)
    {
        $id = mt_rand(1000, 9999);
        $pass = strtolower($data['first_name']);
        $save = new self;
        $save->email = $data['email'];
        $save->matric_number = $data['lecturer_id'];
        $save->first_name = $data['first_name'];
        $save->last_name = $data['last_name'];
        $save->faculty_id = $data['faculty_id'];
        $save->dept_id = $data['department_id'];
        $save->level_id = $data['level_id'];
        $save->course_id = $data['course_id'];
        $save->semester_id = $data['semester_id'];
        $save->role = 'Lecturer';
        $save->password = Hash::make($pass);
        $save->save();
    }

    public function create_student($data)
    {
        $id = mt_rand(1000, 9999);
        $pass = strtolower($data['first_name']);
        $save = new self;
        $save->email = $data['email'];
        $save->matric_number = $data['matric_number'];
        $save->first_name = $data['first_name'];
        $save->last_name = $data['last_name'];
        $save->faculty_id = $data['faculty_id'];
        $save->dept_id = $data['department_id'];
        $save->level_id = $data['level_id'];
        $save->role = 'Student';
        $save->password = Hash::make($pass);
        $save->save();
    }

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
}
