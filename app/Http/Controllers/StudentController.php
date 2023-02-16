<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Student;
class StudentController extends Controller
{
    public function show(Request $request)
    {
        $columns=[
            0=>"id",
            1=>"name",
            2=>"email",
            3=>"mobile"
        ];
        $searchName = $request->get('searchName');


        $totalRecord=Student::count();
        $totalFilered=$totalRecord;

        $limit=$request->input('length');
        $start=$request->input('start');
        $order=$columns[$request->input('order.0.column')];
        $dir=$request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            // $students=Student::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $students=Student::offset($start);
            $students=$students->limit($limit);
            $students=$students->orderBy($order,$dir);
            if(!empty($searchName)){
                $students=$students->where('name',$searchName);
            }
            $students=$students->get();

        }
        else{
            $search=$request->input('search.value');
            $students=Student::where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->orWhere('mobile','LIKE','%'.$search.'%')->offset($start)->limit($limit)->orderBy($order,$dir)->get();

            $totalFilered=Student::where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->orWhere('mobile','LIKE','%'.$search.'%')->count();
        }

        $temp_ary=[];
        if(!empty($students)){
            foreach($students as $student){
                $id=$student->id;
                $edit="<a href='edit/$id'>Edit</a>";
                $result['id']=$student->id;
                $result['name']=$student->name;
                $result['email']=$student->email;
                $result['mobile']=$student->mobile;
                $result['action']=$edit;
                $temp_ary[]=$result;
            }
        }
        // $data=json_decode($temp_ary);
        $json_data=[
            "draw" => intval($request->input('draw')),
            "recordsTotal"=>intval($totalRecord),
            "recordsFiltered"=>intval($totalFilered),
            "data"=>$temp_ary
        ];
        echo json_encode($json_data);


    }
}
