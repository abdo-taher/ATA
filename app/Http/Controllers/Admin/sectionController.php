<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\sectionRequest;
use App\Models\Admin\sectionModel;
use Illuminate\Http\Request;

class sectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = sectionModel::all();
        return view('sections.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(sectionRequest $request)
    {
        try {
            $request->request->add(['added_by'=>auth()->user()->id]);
            $insert = sectionModel::insert($request->except(['_token']));
            if ($insert){
                return redirect()->route('sectionIndex')->with(['success'=>'تم اضافة القسم بنجاح']);
            }else{
                return redirect()->route('sectionIndex')->with(['fail'=>'لم يتم اضافة القسم بنجاح']);
            }

        }catch (Exception $exception){
            return redirect()->route('sectionIndex')->with(['fail'=>'لم تم اضافة القسم بنجاح']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = sectionModel::where('id',$id);
        if ($data){
            return view('sections.edit',compact('data'));
        }else{
            return redirect()->route('sectionIndex')->with(['fail'=>'لا يوجد قسم']);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(sectionRequest $request, $id)
    {
        try{
            $request->request->add(['updated_by' =>auth()->user()->id]);
            $findRow = sectionModel::find($id);
            if($findRow){
                $findRow->update($request->except(['_token']));
                return redirect()->route('sectionIndex')->with(['success'=>' تم تعديل القسم بنجاح']);
            }else{
                return redirect()->route('sectionIndex')->with(['fail'=>'لا يوجد قسم']);
            }

        }catch (Exception $exception){
            return redirect()->route('sectionIndex')->with(['fail'=>'لم يتم تعديل القسم بنجاح']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $findRow = sectionModel::find($id);
        $checkActive = $findRow->active;
        if ($checkActive==0){
            $findRow->delete();
            return redirect()->route('sectionIndex')->with(['success'=>'تم  حذف القسم بنجاح']);
        }elseif ($checkActive==1){
            return redirect()->route('sectionIndex')->with(['fail'=>'لم يتم حذف القسم لانه مفتوح علي النظام']);
        }
    }


    public function active($id){
        try{

            $findRow = sectionModel::find($id);
           $status = $findRow->status == 0 ? 1 : 0;
            $findRow->update(['status'=>$status]);
            if($status == 0){
                return redirect()->route('sectionIndex')->with(['fail'=>'تم الغاء تنشيط القسم بنجاح']);
            }elseif ($status == 1){
                return redirect()->route('sectionIndex')->with(['success'=>'تم  تنشيط القسم بنجاح']);
            }

        }catch (Exception $exception){
            return redirect()->route('shifts')->with(['fail'=>'لم يتم تعديل القسم بنجاح']);
        }
    }

    public function ajaxFunction(Request $request){
        if ($request->ajax()){
           $id = $request->value;
           $data = sectionModel::where('id',$id)->first();
           return view('sections.edit',compact('data'));
        }
    }



}
