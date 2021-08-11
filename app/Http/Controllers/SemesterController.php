<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Faculties;
use App\Models\Level;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index($faculty_id, $dept_id, $level_id, $semester_id)
    {
        if (isset($faculty_id) && $faculty_id != Null && isset($dept_id) && $dept_id != Null  && isset($level_id) && $level_id != Null && isset($semester_id) && $semester_id != Null) {
            try {
                $data['sn'] = 1;
                $data['faculties'] = Faculties::orderBy('name', 'ASC')->get();
                $data['departments'] = Department::orderBy('name', 'ASC')->get();
                $data['levels'] = Level::orderBy('id', 'ASC')->get();
                $data['level'] = Level::find($level_id);
                $data['semesters'] = Semester::orderBy('name', 'ASC')->get();
                $data['semester'] = Semester::find($semester_id);
                $data['department'] = $d = Department::where(['id' => $dept_id, 'faculty_id' => $faculty_id])->with('faculty:id,name,code')->first();
                $data['courses'] = $c = Course::where(function ($query) use ($faculty_id, $dept_id, $level_id, $semester_id) {
                    $query->where('department_id', '=', 0)->orWhere('department_id', '=', $dept_id);
                })->Where(
                    function ($query) use ($faculty_id, $level_id, $semester_id) {
                        $query->where(['faculty_id' => $faculty_id, 'level' => $level_id, 'semester' => $semester_id]);
                    }
                )->get();
                //dd($c);
                return view('web.courses', $data);
            } catch (\Throwable $th) {
                //throw $th;
                dd($th->getMessage());
                return redirect('index');
            }
        } else {
            return redirect('index');
        }
    }
}
