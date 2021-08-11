<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/user', function () {
//     return view('users.index');
// });

Auth::routes();

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
// Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/department/{faculty_id}/{dept_id}', [App\Http\Controllers\DepartmentController::class, 'index']);
Route::get('/level/{faculty_id}/{dept_id}/{level_id}', [App\Http\Controllers\LevelController::class, 'index']);
Route::get('/semester/{faculty_id}/{dept_id}/{level_id}/{semester_id}', [App\Http\Controllers\SemesterController::class, 'index']);
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact']);
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq']);


// Students
Route::group(['prefix' => 'student', 'middleware' => ['auth', 'active', 'student']], function () {
  Route::get('/', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student');

  //Settings
  Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Student\SettingsController::class, 'index'])->name('student_profile');
  Route::post('/change-password', [\App\Http\Controllers\Student\ChangePasswordController::class, 'change'])->name('change-password');

  //Assignment
  Route::get('assignments', [\App\Http\Controllers\Student\SubjectController::class, 'index']);
  Route::get('delete-assignment/{id}', [\App\Http\Controllers\Student\SubjectController::class, 'delete_assignment']);
  Route::match(['get', 'post'], '/submit-assignment', [\App\Http\Controllers\Student\SubjectController::class, 'submit'])->name('submit_assgnment');
  Route::post('/fetch-course', [\App\Http\Controllers\Student\SubjectController::class, 'course']);
});

// Lecturer
Route::group(['prefix' => 'lecturer', 'middleware' => ['auth', 'active', 'lecturer']], function () {
  Route::get('/', [\App\Http\Controllers\Lecturer\DashboardController::class, 'index'])->name('lecturer');

  //Assignments
  Route::get('assignments', [\App\Http\Controllers\Lecturer\SubjectController::class, 'index']);
  Route::get('delete-assignment/{id}', [\App\Http\Controllers\Lecturer\SubjectController::class, 'delete_assignment']);

  //Settings
  Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Lecturer\SettingsController::class, 'index'])->name('lecturer_profile');
  Route::post('/change-password', [\App\Http\Controllers\Lecturer\ChangePasswordController::class, 'change'])->name('lecturer-change-password');
});

//Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
  Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin');

  //Settings
  Route::match(['get', 'post'], '/profile', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin_profile');
  Route::post('/change-password', [\App\Http\Controllers\Admin\ChangePasswordController::class, 'change']);
  Route::get('/change-password', [\App\Http\Controllers\Admin\ChangePasswordController::class, 'index']);
  Route::get('/assignments', [\App\Http\Controllers\Admin\SettingController::class, 'assignment']);
  Route::get('delete-assignment/{id}', [\App\Http\Controllers\Admin\SettingController::class, 'delete_assignment']);

  //Faculties
  Route::match(['get', 'post'], '/faculties', [App\Http\Controllers\Admin\FacultyController::class, 'create'])->name('admin_create_faculty');
  Route::get('/create-faculty', [App\Http\Controllers\Admin\FacultyController::class, 'create_new']);
  Route::get('/edit-faculty/{id}', [App\Http\Controllers\Admin\FacultyController::class, 'edit']);
  Route::get('/view-faculty/{id}', [App\Http\Controllers\Admin\FacultyController::class, 'view']);
  Route::get('/delete-faculty/{id}', [App\Http\Controllers\Admin\FacultyController::class, 'delete']);

  //Departments
  Route::match(['get', 'post'], '/departments', [App\Http\Controllers\Admin\DepartmentController::class, 'create'])->name('admin_create_department');
  Route::get('/create-department', [App\Http\Controllers\Admin\DepartmentController::class, 'create_new']);
  Route::get('/edit-department/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'edit']);
  Route::get('/delete-department/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'delete']);
  Route::get('/view-department-level/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'level']);
  Route::get('/view-dept-level/{faculty}/{id}/{level}', [App\Http\Controllers\Admin\DepartmentController::class, 'dept_level']);


  //Courses
  Route::match(['get', 'post'], '/courses', [App\Http\Controllers\Admin\CoursesController::class, 'create'])->name('admin_create_course');
  Route::get('/create-course', [App\Http\Controllers\Admin\CoursesController::class, 'create_page']);
  Route::post('/fetch-dept', [App\Http\Controllers\Admin\CoursesController::class, 'dept']);
  Route::get('/edit-course/{id}', [App\Http\Controllers\Admin\CoursesController::class, 'edit']);
  Route::get('/view-course/{faculty_id}/{dept_id}/{level_id}/{semester_id}/{course_id}', [App\Http\Controllers\Admin\CoursesController::class, 'view']);
  Route::get('/delete-course/{id}', [App\Http\Controllers\Admin\CoursesController::class, 'delete']);

  //Lecturer
  Route::get('lecturers', [App\Http\Controllers\Admin\LecturerController::class, 'index']);
  Route::match(['get', 'post'], '/add-lecturer', [App\Http\Controllers\Admin\LecturerController::class, 'create'])->name('admin_create_lecturer');
  Route::get('/view-lecturer/{id}', [App\Http\Controllers\Admin\LecturerController::class, 'view']);
  Route::get('/edit-lecturer/{id}', [App\Http\Controllers\Admin\LecturerController::class, 'edit']);
  Route::get('/delete-lecturer/{id}', [App\Http\Controllers\Admin\LecturerController::class, 'delete']);
  Route::get('/block-lecturer/{id}', [App\Http\Controllers\Admin\LecturerController::class, 'block']);
  Route::get('/unblock-lecturer/{id}', [App\Http\Controllers\Admin\LecturerController::class, 'unblock']);
  Route::post('/fetch-course', [App\Http\Controllers\Admin\LecturerController::class, 'course']);

  //Student
  Route::get('students', [App\Http\Controllers\Admin\StudentController::class, 'index']);
  Route::match(['get', 'post'], 'create-student', [App\Http\Controllers\Admin\StudentController::class, 'create'])->name('admin_create_student');
  Route::post('create_bulk_student', [App\Http\Controllers\Admin\StudentController::class, 'create_bulk'])->name('admin_create_bulk_student');
  Route::get('/edit-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'edit']);
  Route::get('/view-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'view']);
  Route::get('/delete-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'delete']);
  Route::get('/block-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'block']);
  Route::get('/unblock-student/{id}', [App\Http\Controllers\Admin\StudentController::class, 'unblock']);

  //Subject
  Route::match(['get', 'post'], '/subjects', [App\Http\Controllers\Admin\SubjectController::class, 'create'])->name('admin_create_subject');
  Route::get('edit-subject/{id}', [App\Http\Controllers\Admin\SubjectController::class, 'edit']);
  Route::get('delete-subject/{id}', [App\Http\Controllers\Admin\SubjectController::class, 'delete']);

  //Classes
  Route::match(['get', 'post'], 'classes', [App\Http\Controllers\Admin\ClassesController::class, 'create'])->name('admin_create_class');
  Route::get('edit-class/{id}', [App\Http\Controllers\Admin\ClassesController::class, 'edit']);
  Route::get('view-class/{id}', [App\Http\Controllers\Admin\ClassesController::class, 'view']);
  Route::get('delete-class/{id}', [App\Http\Controllers\Admin\ClassesController::class, 'delete']);
});
