<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentCollection;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index(){
        $student = Student::orderBy('created_at','DESC');
        if(request()->q !=''){
            $student = $student->where('name', 'LIKE', '%' . request()->q . '%');
        }
        $student = $student->paginate(10);
        return new StudentCollection($student);
    }
}
