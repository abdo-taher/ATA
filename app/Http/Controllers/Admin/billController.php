<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\billExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\billRequest;
use App\Models\User;
use App\Notifications\Admin\BillNotify;
use App\Models\Admin\bill_attachmentModel;
use App\Models\Admin\bill_detailModel;
use App\Models\Admin\billModel;
use App\Models\Admin\productModel;
use App\Models\Admin\sectionModel;
use App\Models\Admin\tax_rateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use mysql_xdevapi\Exception;


class billController extends Controller
{

    function __construct()
    {

        $this->middleware('permission:قائمة الفواتير', ['only' => ['index']]);
        $this->middleware('permission:اضافة فاتورة', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل الفاتورة', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف الفاتورة', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = billModel::all();
        return view('bills.index',compact('data'));
    }
    public function asRead($id)
    {
        $user = User::find(auth()->user()->id);
        $user->unreadNotifications()->where('id',$id)->update(['read_at' => now()]);
        return back();
    }
    public function asReadAll()
    {
        $user = User::find(auth()->user()->id);
        $user->unreadNotifications()->update(['read_at' => now()]);
        return back();
    }

    public function paidType($type)
    {
        if ($type == 'fullPaid'){
            $data = billModel::where('status_id',1)->get();
            $type= 'الفواتير المدفوعة';
        } elseif ($type == 'partiallyPaid'){
            $data = billModel::where('status_id',3)->get();
            $type= 'الفواتير المدفوعة جزئيا';
        }else{
            $data = billModel::where('status_id',2)->get();
            $type= 'الفواتير الغير المدفوعة';
        }
        $data = billModel::all();
        return view('bills.paidType',compact('data','type'));
    }

    public function archive()
    {
        $data = billModel::onlyTrashed()->get();
        if (count($data) == 0 ){
            return back()->with(['fail'=>'لايوجد فواتير مؤرشفة']);
        }
        return view('bills.archive',compact('data'));
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
                    if ($attachments){
                        // save attachment
                        $filename = $request->file_name->getClientOriginalName();
                        $request->file_name->move(base_path('assets/img/billFiles')."/".$request->bill_code , $filename);


                    }
                }
                // send email or notification
                $admin = User::get()->where('role_name',['Owner']);
                $bill_id = billModel::find($id);
                Notification::send($admin,new BillNotify($bill_id));
                return redirect()->route('billIndex')->with(['success'=>'تم اضافة الفاتورة بنجاح']);
            }else{
                return redirect()->route('billIndex')->with(['fail'=>'لم تم اضافة الفاتورة بنجاح']);
            }

        }catch (Exception $exception){

            return redirect()->route('billIndex')->with(['fail'=>'لم تم اضافة الفاتورة بنجاح']);
        }
    }

    public function storeBillAttachment(Request $request){

        $valedate = $this->validate($request,[
            'file_name'=>'required|mimes:pdf,png,jpeg,jpg|unique:bill_attachments,file_name'
        ],[
            'file_name.required' => 'الرجاء ادخال الملحق',
            'file_name.mimes' => 'الرجاء التاكد من امتداد الملحق',
            'file_name.unique' => 'تم ادخل هذا الملحق من قبل',
        ]);
        $file_name = $request->file_name->getClientOriginalName();
        $admin = auth()->user()->id;
        if ($valedate){
            $store_attach = bill_attachmentModel::insert([
                'file_name'=>$file_name,
                'bill_id' => $request->bill_id,
                'bill_code' => $request->bill_code,
                'added_by' => $admin
            ]);
            if ($store_attach){
                $request->file_name->move(base_path('assets/img/billFiles')."/".$request->bill_code , $file_name);
                return back()->with(['success'=>'تم اضافة الملحق للفاتورة']);
            }else{
                return back()->with(['fail'=>'تم اضافة الملحق من قبل']);
            }
        }else{
            return back()->withErrors();
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
                    'updated_by' => auth()->user()->id,
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

    public function paymentUpdate(Request $request , $id){
        try {
        $bill = billModel::find($id);
        $billDetails = bill_detailModel::where('bill_id',$id);
        $totalPayments = $bill->mount_collection-$billDetails->sum('payment_total');
        $valedate = $this->validate($request,[
            'payment_total' => 'required',
        ],[
            'payment_total.required'=>'الرجاء ادخال مبلغ الدفع',
            'payment_total.max'=>'الرجاء التاكد من مبلغ اجمالي مبلغ الفاتورة'
        ]);
            if ($request->payment_total <= $totalPayments){
                $request->request->add([
                    'added_by' => auth()->user()->id,
                    'bill_id' => $billDetails->first()->bill_id,
                    'bill_code' => $billDetails->first()->bill_code,
                    'section_id' => $billDetails->first()->section_id,
                    'product_id' => $billDetails->first()->product_id,
                    'status_id' => $billDetails->first()->status_id ,
                    ]);
                $firstCheck = $request->payment_total + $billDetails->sum('payment_total');
               if ($firstCheck == $bill->mount_collection){

                   $bill->update(['status_id'=>1]);
                   $request->request->add(['status_id' => 1]);
                   bill_detailModel::insert($request->except(['_token','file_name']));
                }elseif ($firstCheck < $bill->mount_collection){

                   $bill->update(['status_id'=>3]);
                   $request->merge(['status_id'=>3]);
                   bill_detailModel::insert($request->except(['_token']));
                }
               if ($request->has('file_name')){
                   $filename = $request->file_name->getClientOriginalName();
                   bill_attachmentModel::insert([
                       'file_name'=>$filename,
                       'bill_code'=>$billDetails->first()->bill_code,
                       'bill_id'=>$billDetails->first()->bill_id,
                       'added_by'=> auth()->user()->id,

                       ]);
                   $request->file_name->move(base_path('assets/img/billFiles')."/".$request->bill_code , $filename);
               }
                return redirect()->route('billIndex')->with(['success'=>'تم اضافة بيانات الدفع بنجاح']);

            }else{
                return redirect()->route('billIndex')->with(['fail'=>'الرجاء ادخال التاكد من اجمالي الفاتورة']);
            }
        }catch (Exception $exception){
            return redirect()->route('billIndex')->with(['fail'=>'لم يتم اضافة بيانات الدفع بنجاح']);
        }

    }

    public function print($bill_code){

        $data = billModel::where('bill_code',$bill_code)->first();
        $details = bill_detailModel::where('bill_code',$bill_code)->get();
        return view('bills.print',compact('data','details'));
    }

    public function deleteAttachment($id)
    {
        $findRow = bill_attachmentModel::find($id);
         $findRow->delete();
         if ($findRow){
              Storage::disk('attachment')->delete("/".$findRow->bill_code . '/' . $findRow->file_name);
             return back()->with(['success'=>'تم  حذف محلقات الفاتورة بنجاح']);
         }else{
             return redirect()->route('billIndex')->with(['fail'=>'لم يتم  حذف محلقات الفاتورة بنجاح']);
         }

    }

    public function toArchive($id)
    {
        $findRow = billModel::find($id);
         $findRow->delete();
         return redirect()->route('billIndex')->with(['success'=>'تم  حذف الفاتورة بنجاح']);

    }
    public function billRestore($id)
    {
         $findRow = billModel::withTrashed()->find($id);
         $findRow->restore();
         return redirect()->route('billIndex')->with(['success'=>'تم  ارجاع الفاتورة بنجاح']);
    }
    public function forceDelete($id)
    {
        $findRow = billModel::withTrashed()->find($id);
        $findRow->forceDelete();
        if ($findRow){
            Storage::disk('attachment')->deleteDirectory("/".$findRow->bill_code);
            return redirect()->route('billIndex')->with(['success'=>'تم  حذف الفاتورة نهائيا بنجاح']);
        }else{
            return redirect()->route('billIndex')->with(['fail'=>'لم يتم  حذف الفاتورة']);
        }

    }
    public function export(Excel $excel)
    {
        return $excel->download(new billExport(), 'bill.xlsx');
    }




    public function ajaxFunction (Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('product')){
                $type = 'product';
            $data = productModel::where('section_id',$request->product)->get(['id','product_name']);

            return view('bills.ajaxReturn',compact('data','type'));
            }
            if ($request->has('addDetails')){
                $type = 'addDetails';
                $id = $request->addDetails;
            return view('bills.ajaxReturn',compact('id','type'));
            }
            if($request->has('id')){
                $type = 'details';
                $id = $request->id;
                $data['key_details'] = billModel::all()->where('id',$id)->first();
                $data['Payment_cases'] = bill_detailModel::all()->where('bill_id',$id);
                $data['Attachments'] = bill_attachmentModel::all()->where('bill_id',$id);
                return view('bills.ajaxReturn',compact('data','type'));
            }

        }

    }

}
