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
                <div class="card-body row">
                    <div class="col-6">
                        <label>اسم القسم</label>
                            <select id="section_id" class="form-control SlectBox SumoUnder"  tabindex="-1">
                                <!--placeholder-->
                                <option value="0">كل الفواتير</option>
                            @foreach($data as $info)
                                    <option value="{{$info->id}}">{{$info->section_name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div id="hideProduct" class="col-lg-6">
                        <label>اسم المنتج</label>
                        <input class="form-control" id="product_show"  type="button" value="ابحث بالمنتج ايضا">
                    </div>
                    <div id="showProduct" class="col-lg-6" hidden>
                        <label>اسم المنتج</label>
                        <div class="input-group">
                            <select id="product_id" class="form-control SlectBox SumoUnder"  tabindex="-1">
                                <!--placeholder-->
                                <option>كل المنتجات</option>
                            </select>
                            <span title="اخفاء المنتج" id="product_hide" class="input-group-btn"><button class="btn btn-light" type="button"><span class="input-group-btn"><i class="fa fa-trash"></i></span></button></span>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-6">
                        <label>تاريخ الاصدار</label>
                        <div class="input-group">
                            <input class="form-control" id="dateStart"  type="date">
                            <span title="مسح التاريخ" id="dateStart_null" class="input-group-btn"><button class="btn btn-light" type="button"><span class="input-group-btn"><i class="fa fa-trash"></i></span></button></span>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-6">
                        <label>تاريخ التحصيل</label>
                        <div class="input-group">
                            <input class="form-control" id="dateEnd"  type="date">
                            <span title="مسح التاريخ" id="dateEnd_null" class="input-group-btn"><button class="btn btn-light" type="button"><span class="input-group-btn"><i class="fa fa-trash"></i></span></button></span>
                        </div><!-- input-group -->
                    </div>

                    <div class="col-12">
                    <br>
                        <button id="submitBtn" class="btn btn-primary btn-block">ابحث</button>
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
            $(document).on('click','#product_show',function (){
                $('#showProduct').removeAttr('hidden');
                $('#hideProduct').attr('hidden','');
            })
            $(document).on('click','#product_hide',function (){
                $('#hideProduct').removeAttr('hidden');
                $('#showProduct').attr('hidden','');
                $('#product_id').val(null)
            })
            $(document).on('click','#submitBtn',function (){
                var sectionSelect = $('#section_id').val();
                var productSelect = $('#product_id').val();
                var startDate = $('#dateStart').val();
                var endDate = $('#dateEnd').val();
                var type = 'customerSelect';
                jQuery.ajax({
                    url:'{{route('reportsAjax')}}',
                    type:'post',
                    'dataType':'html',
                    cache:false,
                    data: {'_token': '{{csrf_token()}}', sectionSelect , productSelect , startDate, endDate,type},
                    success:function (data){
                        $('.body-card').html(data)
                    },error:function (){

                    }

                })
            })
            $(document).on('change','#section_id', function (){
                var product = $(this).val();
                jQuery.ajax({
                    url:'{{route('billAjax')}}',
                    type:'post',
                    'dataType':'html',
                    cache:false,
                    data:{'_token':'{{csrf_token()}}',product},
                    success:function (data){
                        $('#product_id').html(data);
                    },
                    error:function (){

                    }
                })
            })
            $(document).on('click','#dateStart_null',function (){
                $('#dateStart').val('');
            })
            $(document).on('click','#dateEnd_null',function (){
                $('#dateEnd').val('');
            })
        })
    </script>
@endsection
