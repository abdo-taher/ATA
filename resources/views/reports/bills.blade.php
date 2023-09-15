@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تقارير الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ القائمة</span>
            </div>
        </div>

        <div class="d-flex my-xl-auto right-content">

        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            @include('layouts.alerts')
            <div class="card">
                <div class="card-body">
                    <div class="typeSearch row">
                    <input class="btn btn-light col-6" id="searchDateBtn"  type="button" value="بحث بالتاريخ">
                    <input class="btn btn-light col-6" id="searchCodeBtn"  type="button" value="بحث برقم الفاتورة">
                    </div>
                    <br/>
                    <div id="searchDate" class="row">
                        <div class="col-12">
                            <label>نوع الفاتورة</label>
                            <select class="form-control select2" id="selectType" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option value="0">
                                    كل الفواتير
                                </option>
                                <option value="1">
                                    الفواتير المدفوعة
                                </option>
                                <option value="3">
                                    الفواتير المدفوعة جزئيا
                                </option>
                                <option value="2">
                                    الفواتير الغير مدفوعة
                                </option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label>تاريخ الاصدار</label>
                            <input class="form-control" id="dateStart"  type="date">
                        </div>
                        <div class="col-6">
                            <label>تاريخ التحصيل</label>
                            <input class="form-control" id="dateEnd"  type="date">
                        </div>
                    </div>
                    <br/>
                    <div id="searchCode" class="row" hidden>
                        <label>كود الفاتورة</label>
                        <input class="form-control col-12" id="billCode" placeholder="ادخل رقم الفاتورة"  type="number">
                    </div>
                    <div class="row ">
                        <button id="submitBtn" class="btn btn-icon btn-primary flex-fill">ابحث</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">ويمكن التصدير وفلترت النتائج من خلال الاتي:</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                <tr>
                                    <th>رقم الفاتورة</th>
                                    <th>تاريخ الاصدار</th>
                                    <th>الادمن الذي اضافها</th>
                                    <th>تاريخ الاستحقاق</th>
                                    <th>القسم</th>
                                    <th>المنتج</th>
                                    <th>اجمالي الدخل</th>
                                    <th>الحاله</th>
                                </tr>
                                </thead>
                                <tbody class="body-card">
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>

    <script>
        $(document).ready(function (){
            $(document).on('click','#searchCodeBtn',function (){
                $('#searchCode').removeAttr('hidden');
                $('#searchDate').attr('hidden','');
                $('#submitBtn').attr('hidden','');
                $('.body-card').html('')
            })
            $(document).on('click','#searchDateBtn',function (){
                $('#searchDate').removeAttr('hidden');
                $('#submitBtn').removeAttr('hidden');
                $('#searchCode').attr('hidden','');
                $('.body-card').html('')
            })
            $(document).on('click','#submitBtn',function (){
                var selectType = $('#selectType').val();
                var startDate = $('#dateStart').val();
                var endDate = $('#dateEnd').val();
                var type = 'billsSelect';
                jQuery.ajax({
                    url:'{{route('reportsAjax')}}',
                    type:'post',
                    'dataType':'html',
                    cache:false,
                    data: {'_token': '{{csrf_token()}}', selectType, startDate, endDate,type},
                    success:function (data){
                        $('.body-card').html(data)
                    },error:function (){

                    }

                })
            })
            $(document).on('input','#billCode',function (){
                var billCode = $('#billCode').val();
                var type = 'billsCode';
                jQuery.ajax({
                    url:'{{route('reportsAjax')}}',
                    type:'post',
                    'dataType':'html',
                    cache:false,
                    data: {'_token': '{{csrf_token()}}' ,billCode,type},
                    success:function (data){
                        $('.body-card').html(data)
                    },error:function (){

                    }

                })
            })
        })
    </script>
@endsection
