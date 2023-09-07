<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\productRequest;
use App\Models\Admin\productModel;
use App\Models\Admin\sectionModel;
use Illuminate\Http\Request;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = productModel::all();
        $section = sectionModel::get(['id','section_name']);
        return view('products.index',compact('data','section'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(productRequest $request)
    {
        try {
            $request->request->add(['added_by'=>auth()->user()->id]);
            $insert = productModel::insert($request->except(['_token']));
            if ($insert){
                return redirect()->route('productIndex')->with(['success'=>'تم اضافة المنتج بنجاح']);
            }else{
                return redirect()->route('productIndex')->with(['fail'=>'لم يتم اضافة المنتج بنجاح']);
            }

        }catch (Exception $exception){
            return redirect()->route('productIndex')->with(['fail'=>'لم تم اضافة المنتج بنجاح']);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(productRequest $request, $id)
    {
        try{
            $request->request->add(['updated_by' =>auth()->user()->id]);
            $findRow = productModel::find($id);
            if($findRow){
                $findRow->update($request->except(['_token']));
                return redirect()->route('productIndex')->with(['success'=>' تم تعديل المنتج بنجاح']);
            }else{
                return redirect()->route('productIndex')->with(['fail'=>'لا يوجد منتج']);
            }

        }catch (Exception $exception){
            return redirect()->route('productIndex')->with(['fail'=>'لم يتم تعديل المنتج بنجاح']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $findRow = productModel::find($id);
        $checkActive = $findRow->active;
        if ($checkActive==0){
            $findRow->delete();
            return redirect()->route('productIndex')->with(['success'=>'تم  حذف المنتج بنجاح']);
        }elseif ($checkActive==1){
            return redirect()->route('productIndex')->with(['fail'=>'لم يتم حذف المنتج لانه مفتوح علي النظام']);
        }
    }


    public function active($id){
        try{

            $findRow = productModel::find($id);
            $status = $findRow->status == 0 ? 1 : 0;
            $findRow->update(['status'=>$status]);
            if($status == 0){
                return redirect()->route('productIndex')->with(['success'=>'تم الغاء تنشيط المنتج بنجاح']);
            }elseif ($status == 1){
                return redirect()->route('productIndex')->with(['success'=>'تم  تنشيط المنتج بنجاح']);
            }

        }catch (Exception $exception){
            return redirect()->route('shifts')->with(['fail'=>'لم يتم تعديل المنتج بنجاح']);
        }
    }

    public function ajaxFunction(Request $request){
        if ($request->ajax()){
            $id = $request->value;
            $data = productModel::where('id',$id)->first();
            $section = sectionModel::get(['id','section_name']);
            return view('products.edit',compact('data','section'));
        }
    }



}
