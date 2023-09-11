@extends('layouts.master')
@section('css')
    <style>
    @media print {
        #printBtn , #sendBtn{
            display: none;
        }
    }
    </style>
@endsection
@section('title')
    طباعة الفواتير
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير</span><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طباعة</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm" >
        <div class="col-md-12 col-xl-12">
            <div class="main-content-body-invoice" id="printSection">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title"><img src="{{asset('assets/img/ATA-logo.png')}}" style="width: 100px;height: 100px"></h1>
                            <div class="billed-from">
                                <h6>شركة ATA التحدة</h6>
                                <p>874, المنصورة , حي الجامعة<br>
                                    رقم الهاتف : 01008275881<br>
                                    البريد الاليكتروني: ata@company.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20 col-12">
                            <div class="col-6">
                                <label class="tx-gray-600 text-center">معلومات الفاتورة</label>
                                <p class="invoice-info-row"><span>رقم الفاتورة :</span> <span>{{$data->bill_code}}</span></p>
                                <p class="invoice-info-row"><span>اسم القسم :</span> <span>{{$data->section->section_name}}</span></p>
                                <p class="invoice-info-row"><span>اسم المنتج :</span> <span>{{$data->product->product_name}}</span></p>
                                <p class="invoice-info-row"><span>تاريخ التحصيل :</span> <span>{{$data->due_date}}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                <tr>
                                <tr>
                                    <th class="wd-20p">حالة الفاتورة</th>
                                    <th class="wd-40p">ملاحظات</th>
                                    <th class="tx-center">اجمالي الدفع</th>
                                    <th class="tx-right">تاريخ الدفع </th>
                                    <th class="tx-right">تايخ الانشاء</th>
                                </tr>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($details as $info)
                                    <tr>
                                        <td class="
                                            @if($info->status->id == 2)
                                                bg-danger-transparent
                                            @elseif($info->status->id == 1)
                                                bg-success-transparent
                                            @else
                                                bg-primary-transparent
                                            @endif
                                            ">
                                            {{$info->status->status_name}}
                                        </td>
                                        <td class="tx-12">
                                            @if($info->note)
                                                {{$info->note}}
                                            @else
                                                لا يوجد ملاحظات
                                            @endif</td>
                                        <td class="tx-center">
                                            @if($info->payment_total)
                                                {{$info->payment_total}}
                                            @else
                                                لم يدفع شيئ
                                            @endif
                                        </td>
                                        <td class="tx-right">
                                            @if($info->payment_date)
                                                {{$info->payment_date}}
                                            @else
                                                لم يدفع شيئ
                                            @endif</td>
                                        <td class="tx-right">{{$info->created_at}}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td class="valign-middle" colspan="2" rowspan="4">
                                        <div class="invoice-notes">
                                            <label class="main-content-label tx-13">تفاصيل الفاتورة الرئسية</label>
                                        </div><!-- invoice-notes -->
                                    </td>
                                    <td class="tx-right">نسبة الضريبة </td>
                                    <td class="tx-right" colspan="2">{{$data->discount_rate->discount_rate}}%</td>
                                </tr>
                                <tr>
                                    <td class="tx-right">المتبقي من الدفع</td>
                                    <td class="tx-right" colspan="2">{{$data->mount_collection-$details->sum('payment_total')}}</td>
                                </tr>
                                <tr>
                                    <td class="tx-right">اجمالي التحصيل</td>
                                    <td class="tx-right" colspan="2">{{$data->mount_collection}}</td>
                                </tr>
                                <tr>
                                    <td class="tx-right tx-uppercase tx-bold tx-inverse">اجمالي الدفع</td>
                                    <td class="tx-right" colspan="2">
                                        <h4 class="tx-primary tx-bold">{{$details->sum('payment_total')}}</h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">
                        <button id="#printBtn" onclick="printDiv()"  class="btn btn-primary mt-3 mr-2" ><i  class="mdi mdi-printer ml-1"></i>طباعة</button>
                        <button id="#sendBtn"   class="btn btn-success mt-3 mr-2" ><i class="mdi mdi-telegram ml-1"></i>ارسال</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

    <script>

        function printDiv() {
            var printSection = document.getElementById('printSection').innerHTML;
            var printDev = document.body.innerHTML;
            document.body.innerHTML = printSection;
            window.print();
            document.body.innerHTML = printDev;
            location.reload();
        }

    </script>
@endsection
