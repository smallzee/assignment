<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $data)
    {
        $id = mt_rand(1000, 9999);
        //dd($data);
        return new User([
            'email' => $data['email'],
            'matric_number' => $data['matric_number'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'faculty_id' => Session::get('bulk_faculty_id'),
            'dept_id' => Session::get('bulk_department_id'),
            'level_id' => Session::get('bulk_level_id'),
            'role' => 'Student',
            'password' => Hash::make(strtolower($data['first_name'])),
        ]);
    }
}
