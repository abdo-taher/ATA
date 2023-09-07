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
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ القائمة</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
                            <a href="{{route('billCreate')}}" class="tx-12 tx-gray-500 mb-2 btn btn-outline-secondary float-left"><i class="fa fa-plus"></i></a>
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
                                <div class="table-responsive">
                                    <table class="table text-md-nowrap table-hover" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p border-bottom-0">رقم الفاتورة</th>
                                            <th class="wd-15p border-bottom-0">تاريخ الاصدار</th>
                                            <th class="wd-10p border-bottom-0">الادمن الذي اضافها</th>
                                            <th class="wd-15p border-bottom-0">تاريخ الاستحقاق</th>
                                            <th class="wd-10p border-bottom-0">المنتج</th>
                                            <th class="wd-10p border-bottom-0">القسم</th>
                                            <th class="wd-10p border-bottom-0">الاجمالي مع الضريبة</th>
                                            <th class="wd-10p border-bottom-0">الحاله</th>
                                            <th class="wd-25p border-bottom-0">الاعدادت</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(($data))
                                            @foreach($data as $info )
                                                <tr>
                                                    <td><span class="badge badge-success float-left">{{$info->discount_rate->discount_rate}}%</span>{{$info->bill_code}}</td>
                                                    <td>{{$info->bill_date}}</td>
                                                    <td>{{$info->added->name}}</td>
                                                    <td>{{$info->due_date}}</td>
                                                    <td>{{$info->section->section_name}}</td>
                                                    <td>{{$info->product->product_name}}</td>
                                                    <td>{{$info->total}}</td>
                                                    <td >
                                                        <span class="
                                                                @if($info->status->id == 2)
                                                                    badge badge-danger
                                                                @elseif($info->status->id == 1)
                                                                    badge badge-success
                                                                @else
                                                                    badge badge-secondary
                                                                @endif
                                                         ">{{$info->status->status_name}}</span>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                        <a title="عرض تفاصيل الفاتورة" id="billDeL"  data-id="{{$info->id}}" class="col-md-3 btn-icon btn btn-outline-secondary m-1" data-target="#modaldemo3" data-toggle="modal"><i class="typcn typcn-eye-outline"></i></a>
                                                        <a title="تعديل بيانات الفاتورة"  href="{{route('billEdit',$info->bill_code)}}" class="col-md-3 btn-icon btn btn-outline-success m-1"><i class="typcn typcn-edit"></i></a>
                                                        <a title="حذف الفاتورة"  href="{{route('billDelete',$info->id)}}" class="col-md-3 btn-icon  btn btn-outline-danger m-1" id='swal-parameter' ><i class="typcn typcn-delete-outline"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        @include('bills.details')
                                    </table>
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
            $(document).on('click','#billDeL',function (){
                var id = $(this).data('id');
                jQuery.ajax({
                    url:'{{route('billAjax')}}',
                    type:'post',
                    "dataType":"html",
                    cache:false,
                    data:{'_token':'{{csrf_token()}}' , id },
                    success:function (data){
                        $('.modal').html(data)
                    },
                    error:function (){
                        $('.modal').html('<h5 style="color:red">عفوا لا يوجد بيانات لعرضها</h5>')
                    }

                })

            })
        })
    </script>
@endsection
