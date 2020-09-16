<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oex_category;
use App\Oex_exam_master;
use Validator;
class Admin extends Controller
{
    public function index(){
        
        return view('admin.dashboard');
    }
    public function exam_category(){
        $data['category']=Oex_category::get()->toArray();
        // echo '<pre>';
        // print_r($data);die;
        return view('admin.exam_category',$data);
    }
    public function add_new_category(Request $request)
    {
        $validator=Validator::make($request->all(),['name'=>'required']);
        if($validator->passes())
        {
            $cat = new Oex_category();
            $cat->name=$request->name;
            $cat->status= 1;
            $cat->save();
            $arr=array('status'=>'true','message'=>'success','reload'=>url('/admin/exam_category'));
        }
        else{
            $arr = array('status'=>'false','message'=>$validator->errors()->all());
        }
        echo json_encode($arr);
    }
    
    public function delete_category($id){
        $cat = Oex_category::where('id',$id)->get()->first();
        $cat->delete();
        return redirect(url('admin/exam_category'));
    }
    public function edit_category($id){
       $category = Oex_category::where('id',$id)->first();
       return view('admin.edit_category',['categories'=>$category]);
    }
    public function edit_new_category(Request $request)
    {
        $cat = Oex_category::where('id',$request->id)->get()->first();
        $cat->name=$request->name;
        $cat->update();
        echo json_encode(array('status'=>'true','message'=>'Category successfully edited','reload'=>url('/admin/exam_category')));
    }
    public function category_status($id){
        $cat = Oex_category::where('id',$id)->get()->first();
        if($cat->status==1)
            $status=0;
        else
            $status=1;
            
            $cat1 = Oex_category::where('id',$id)->get()->first();
            $cat1->status = $status;
            $cat1->update();
    }

    public function manage_exam(){

        $data['category']=Oex_category::where('status','1')->get()->toArray();
        $data['exams'] = Oex_exam_master::select(['oex_exam_masters.*','oex_categories.name as cat_name'])->join('oex_categories','oex_exam_masters.category','=','oex_categories.id')->get()->toArray();
        return view('admin.manage_exam',$data);
    }
    public function add_new_exam(Request $request){
        $validator = validator::make($request->all(),['title'=>'required','exam_date'=>'required','exam_category'=>'required']);
        if($validator->passes())
        {
            $exam = new Oex_exam_master();
            $exam->title = $request->title;
            $exam->exam_date= $request->exam_date;
            $exam->category = $request->exam_category;
            $exam->status = 1;
            $exam->save();
            $arr = array('status'=>'true','message'=>'Exam successfully Added','reload'=>url('admin/manage_exam'));
        }
        else
        {
            $arr = array('status'=>'false','message'->$validator->errors()->all());
        }
        echo json_encode($arr);
    }
    public function exam_status($id){
        $exam = Oex_exam_master::where('id',$id)->get()->first();
        if($exam->status==1)
            $status=0;
        else
            $status=1;
            
            $exam1 = Oex_exam_master::where('id',$id)->get()->first();
            $exam1->status = $status;
            $exam1->update();
    }
    public function delete_exam($id){
        $exam1 = Oex_exam_master::where('id',$id)->get()->first();
        $exam1->delete();
        return redirect(url('/admin/manage_exam'));
    }
}
