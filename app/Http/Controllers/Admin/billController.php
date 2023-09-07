<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\billRequest;
use App\Models\Admin\bill_attachmentModel;
use App\Models\Admin\bill_detailModel;
use App\Models\Admin\billModel;
use App\Models\Admin\productModel;
use App\Models\Admin\sectionModel;
use App\Models\Admin\tax_rateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class billController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = billModel::all();
        return view('bills.index',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = sectionModel::get(['id','section_name']);
        $product = productModel::get(['id','product_name']);
        $tax_rate = tax_rateModel::get(['id','discount_rate']);
        return view('bills.add',compact('sections','tax_rate','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(billRequest $request)
    {
        try {

        DB::beginTransaction();
            $request->request->add(['added_by'=>auth()->user()->id]);
            $id = billModel::insertGetId($request->except(['_token','file_name']));
            if ($id){
                $details = bill_detailModel::insert([
                'bill_code' => $request->bill_code,
                'bill_id'  => $id,
                'section_id'  => $request->section_id ,
                'product_id'  => $request->product_id ,
                'payment_date' => $request->payment_date,
                'added_by' => $request->added_by,
                ]);
            }
            if ($details){
                if ($request->has('file_name')){
                    $filename = $request->file_name->getClientOriginalName();
                    $attachments = bill_attachmentModel::insert([
                    'file_name' => $filename,
                    'bill_id' => $id,
                    'bill_code' => $request->bill_code,
                    'added_by' => $request->added_by,
                    ]);
                }
                if ($attachments){
                    $filename = $request->file_name->getClientOriginalName();
                    $request->file_name->move(base_path('assets/img/billFiles')."/".$request->bill_code , $filename);
                    return redirect()->route('billIndex')->with(['success'=>'تم اضافة الفاتورة بنجاح']);
                }
            }else{
                return redirect()->route('billIndex')->with(['fail'=>'لم تم اضافة الفاتورة بنجاح']);
            }
        DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
            return redirect()->route('billIndex')->with(['fail'=>'لم تم اضافة الفاتورة بنجاح']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($bill_code)
    {
        $data = billModel::where('bill_code',$bill_code)->first();
        $id = $data->id;
        $file_name = bill_attachmentModel::where('bill_id',$id)->get(['file_name'])->first();
        if ($data){
            $sections = sectionModel::get(['id','section_name']);
            $product = productModel::get(['id','product_name']);
            $tax_rate = tax_rateModel::get(['id','discount_rate']);
            return view('bills.edit',compact('data','sections','product','tax_rate','file_name'));
        }else{
            return redirect()->route('billIndex')->with(['fail'=>'لا يوجد فاتورة']);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(billRequest $request, $id)
    {

        try{

            $request->request->add(['updated_by' => auth()->user()->id]);
            $bill_id = billModel::find($id);
             $bill_id->update($request->except(['_token']));
            if ($bill_id){
                $details = bill_detailModel::where('bill_id',$id)->get(['id']);
                $details_id = bill_detailModel::find($details)->first();
                $details_id->update([
                    'bill_code' => $request->bill_code,
                    'bill_id'  => $id,
                    'section_id'  => $request->section_id ,
                    'product_id'  => $request->product_id ,
                    'payment_date' => $request->payment_date,
                    'updated_by' => $request->updated_by,
                ]);
            }
            if ($details_id){
                $attachments = bill_attachmentModel::where('bill_id',$id)->get(['id']);
                $attachments_id = bill_attachmentModel::find($attachments)->first();
                if ($request->has('file_name')){
                    $filename = $request->file_name->getClientOriginalName();
                    $attachments_id->update([
                        'file_name' => $filename,
                        'bill_id' => $id,
                        'bill_code' => $request->bill_code,
                        'updated_by' => $request->updated_by,
                    ]);
                    if ($attachments_id){
                        $filename = $request->file_name->getClientOriginalName();
                        $request->file_name->move(base_path('assets/img/billFiles')."/".$request->bill_code , $filename);
                        return redirect()->route('billIndex')->with(['success'=>'تم تعديل الفاتورة بنجاح']);
                    }
                }else{
                    $attachments_id->update([
                        'bill_code' => $request->bill_code,
                        'updated_by' => $request->updated_by,
                    ]);
                    return redirect()->route('billIndex')->with(['success'=>'تم تعديل الفاتورة بنجاح']);
                }

            }else{
                return redirect()->route('billIndex')->with(['fail'=>'لم يتم تعديل الفاتورة بنجاح']);
            }

        }catch (Exception $exception){

            return redirect()->route('billIndex')->with(['fail'=>'لم يتم تعديل الفاتورة بنجاح']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $findRow = billModel::find($id);
         $findRow->delete();
         return redirect()->route('billIndex')->with(['success'=>'تم  حذف الفاتورة بنجاح']);

    }




    public function ajaxFunction (Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('product')){
                $type = 'product';
                $id = $request->product;
            $data = productModel::all()->where('id',$id);

            return view('bills.ajaxReturn',compact('data','type'));
            }
            if($request->has('id')){
                $type = 'details';
                $id = $request->id;
                $data['key_details'] = billModel::all()->where('id',$id)->first();
                $data['Payment_cases'] = bill_detailModel::all()->where('bill_id',$id)->first();
                $data['Attachments'] = bill_attachmentModel::all()->where('bill_id',$id)->first();
                return view('bills.ajaxReturn',compact('data','type'));
            }

        }

    }

}
