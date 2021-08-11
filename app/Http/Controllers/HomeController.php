<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculties;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $data['faculties'] = Faculties::orderBy('name', 'ASC')->get();
    $data['departments'] = Department::orderBy('name', 'ASC')->get();
    return view('web.index', $data);
  }
  public function about()
  {
    return view('web.about');
  }
  public function contact()
  {
    return view('web.contact');
  }
  public function faq()
  {
    return view('web.faq');
  }
}
