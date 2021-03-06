<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentType;
use App\ClassName;
use DB;

class StudentTypeController extends Controller
{
    public function index()
    {
        // $studentTypes = DB::table('student_types')
        //             ->join('class_names','student_types.class_id','=','class_names.id')
        //             ->select('student_types.*','class_names.class_name')
        //             ->get();

        $studentTypes = $this->getStudentType();
        
        $classes  = ClassName::all();
        return view('admin.settings.student-type.student-type-list',compact('studentTypes','classes'));
    }

    public function studentTypeAdd(Request $request)
    {
        if ($request->ajax()) 
        {
            $data = new StudentType();
            $data->class_id     = $request->class_id; //from ajax
            $data->student_type = $request->student_type; //from ajax
            $data->status = 1;
            $data->save();
        }
    }

    public function studentTypeList()
    {
        $studentTypes = $this->getStudentType();
        $classes  = ClassName::all();
        return view('admin.settings.student-type.student-type-table',compact('studentTypes','classes'));
    }

    public function studentTypeUnpublish(Request $request)
    {
        $data = StudentType::find($request->type_id); //from ajax
        $data->status = 2;
        $data->save();

        $studentTypes = $this->getStudentType();
        $classes  = ClassName::all();
        return view('admin.settings.student-type.student-type-table',compact('studentTypes','classes'));
    }
    
    public function studentTypePublish(Request $request)
    {
        $data = StudentType::find($request->type_id); //from ajax
        $data->status = 1;
        $data->save();

        $studentTypes = $this->getStudentType();
        $classes  = ClassName::all();
        return view('admin.settings.student-type.student-type-table',compact('studentTypes','classes'));
    }

    public function studentTypeUpdate(Request $request)
    {
        $data = StudentType::find($request->type_id); 
        $data->student_type = $request->student_type; 
        $data->update();

        $studentTypes = $this->getStudentType();
        $classes  = ClassName::all();
        return view('admin.settings.student-type.student-type-table',compact('studentTypes','classes'));
    }

    public function studentTypeDelete(Request $request)
    {
        $data = StudentType::find($request->type_id); //from ajax
        // $data->delete();
        $data->status = 3 ; //for future recovery purpose
        $data->save();
        
        $studentTypes = $this->getStudentType();
        $classes  = ClassName::all();
        return view('admin.settings.student-type.student-type-table',compact('studentTypes','classes'));
    }

    protected function getStudentType()
    {
        $studentTypes = DB::table('student_types')
                    ->join('class_names','student_types.class_id','=','class_names.id')
                    ->select('student_types.*','class_names.class_name')
                    ->where('student_types.status', '!=', 3)
                    ->get();
        return $studentTypes;
    }    
}
