<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Faculties;
use App\Models\Level;
use App\Models\Semester;

class LevelController extends Controller
{
  public function index($faculty_id, $dept_id, $level_id)
  {
    if (isset($faculty_id) && $faculty_id != Null && isset($dept_id) && $dept_id != Null  && isset($level_id) && $level_id != Null) {
      try {
        $data['faculties'] = Faculties::orderBy('name', 'ASC')->get();
        $data['departments'] = Department::orderBy('name', 'ASC')->get();
        $data['levels'] = Level::orderBy('id', 'ASC')->get();
        $data['level'] = $l = Level::find($level_id);
        $data['semesters'] = Semester::orderBy('name', 'ASC')->get();
        $data['department'] = $d = Department::where(['id' => $dept_id, 'faculty_id' => $faculty_id])->with('faculty:id,name,code')->first();
        //dd($d->faculty->id);
        return view('web.semester', $data);
      } catch (\Throwable $th) {
        //throw $th;
        return redirect('index');
      }
    } else {
      return redirect('index');
    }
  }
}
