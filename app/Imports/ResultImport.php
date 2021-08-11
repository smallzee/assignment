<?php

namespace App\Imports;

use App\Models\Result;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;

class ResultImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $data) {
            $save = Result::where(['student_id' => $data[2], 'subject_id' => Auth::user()->class_id, 'class_id' => Session::get('class_id')])->first();
            if ($save != null) {                
                $save->first_test = $data[3];
                $save->second_test = $data[4];
                $save->exam = $data[5];
                $save->save();
            }
            next($data);
        }
    }
}
