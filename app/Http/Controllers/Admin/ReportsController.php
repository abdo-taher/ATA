<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\billModel;
use App\Models\Admin\sectionModel;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    function __construct()
    {

        $this->middleware('permission:التقارير', ['only' => ['index']]);
        $this->middleware('permission:تقرير الفواتير', ['only' => ['Bills']]);
        $this->middleware('permission:تقرير العملاء', ['only' => ['Customer']]);

    }

    public function bills(){
        return view('Reports.bills');
    }
    public function customer(){
        $data = sectionModel::all();
    return view('Reports.customer',compact('data'));
}

    public function reportsAjax(Request $request){
        $data = [];
        if ($request->type == 'billsSelect' || $request->type == 'billsCode'){

        if ($request->type == 'billsSelect'){
           if ($request->selectType == 0 && $request->startDate == null && $request->endDate == null){

               $data = billModel::all();

           }elseif(($request->selectType && $request->startDate == null && $request->endDate == null)){

                $data = billModel::where('status_id',$request->selectType);

           }elseif($request->selectType && $request->startDate && $request->endDate){

                $data = billModel::where([['status_id',$request->selectType],['bill_date',$request->startDate],['due_date',$request->endDate]])->get();

           }elseif($request->selectType == 0 && $request->startDate == null && $request->endDate){

                $data = billModel::where([['due_date',$request->endDate]])->get();

           }elseif($request->selectType == 0 && $request->startDate && $request->endDate == null){

                $data = billModel::where([['bill_date',$request->startDate]])->get();

           }elseif($request->selectType == 0 && $request->startDate && $request->endDate){

                $data = billModel::where([['bill_date',$request->startDate],['due_date',$request->endDate]])->get();

           }elseif($request->selectType  && $request->startDate == null && $request->endDate){

                $data = billModel::where([['status_id',$request->selectType],['due_date',$request->endDate]])->get();

           }elseif($request->selectType && $request->startDate && $request->endDate == null){

                $data = billModel::where([['status_id',$request->selectType],['bill_date',$request->startDate]])->get();

           }elseif($request->selectType && $request->startDate && $request->endDate ){

                $data = billModel::where([['status_id',$request->selectType],['bill_date',$request->startDate],['due_date',$request->endDate]])->get();

           }
        }
        if ($request->type == 'billsCode'){
            $data = billModel::Where('bill_code', 'like', '%' . $request->billCode . '%')->get();
        }
        }
        if($request->type == 'customerSelect'){
            if ($request->sectionSelect == 0 && $request->startDate == null && $request->endDate == null){

                $data = billModel::all();

            }elseif($request->sectionSelect == 0 && $request->startDate  && $request->endDate ){

                $data = billModel::where('section_id',$request->sectionSelect)->get();

            }elseif(($request->sectionSelect && $request->productSelect == 0 && $request->startDate == null && $request->endDate == null)){

                $data = billModel::where('section_id',$request->sectionSelect)->get();

            }elseif(($request->sectionSelect == 0 && $request->startDate && $request->endDate )){

                $data = billModel::where([['due_date',$request->endDate],['bill_date',$request->startDate]])->get();

            }elseif(($request->sectionSelect && $request->productSelect && $request->startDate == null && $request->endDate == null)){

                $data = billModel::where([['section_id',$request->sectionSelect],['product_id',$request->productSelect]])->get();

            }elseif(($request->sectionSelect && $request->productSelect && $request->startDate == null && $request->endDate)){

                $data = billModel::where([['section_id',$request->sectionSelect],['product_id',$request->productSelect],['due_date',$request->endDate]])->get();

            }elseif(($request->sectionSelect && $request->productSelect && $request->startDate && $request->endDate == null)){

                $data = billModel::where([['section_id',$request->sectionSelect],['product_id',$request->productSelect],['bill_date',$request->startDate]])->get();

            }elseif($request->sectionSelect && $request->productSelect ==0 && $request->startDate && $request->endDate){

                $data = billModel::where([['section_id',$request->sectionSelect],['bill_date',$request->startDate],['due_date',$request->endDate]])->get();

            }elseif($request->sectionSelect && $request->productSelect && $request->startDate == null && $request->endDate){

                $data = billModel::where([['section_id',$request->sectionSelect],['product_id',$request->productSelect],['due_date',$request->endDate]])->get();

            }elseif($request->sectionSelect && $request->productSelect && $request->startDate && $request->endDate == null){

                $data = billModel::where([['section_id',$request->sectionSelect],['product_id',$request->productSelect],['bill_date',$request->startDate]])->get();

            }elseif($request->sectionSelect && $request->productSelect && $request->startDate && $request->endDate){

                $data = billModel::where([['section_id',$request->sectionSelect],['product_id',$request->productSelect],['bill_date',$request->startDate],['due_date',$request->endDate]])->get();

            }
        }
        return view('reports.ajaxReturn',compact('data'));
    }
}
