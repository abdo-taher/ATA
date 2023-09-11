@extends('layouts.master')
@section('title')
قائمة الفواتير
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
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

					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@include('layouts.alerts')
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">

                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <a title="إضافة فاتورة جديدة" href="{{route('billCreate')}}" class="tx-12 tx-gray-500 mb-2 btn btn-outline-secondary "><i class="fa fa-plus"></i>  إضافة فاتورة</a>
                                    <a title="ارشيف الفواتير" href="{{route('billArchive')}}" class="tx-12 tx-gray-500 mb-2 btn btn-outline-secondary "><i class="fa fa-archive"></i>  ارشيف الفواتير</a>
                                    <a title="تصدير اكسيل" href="{{route('exportExcel')}}" class="tx-12 tx-gray-500 mb-2 btn btn-outline-secondary "><i class="fa fa-file-export"></i>  تصدير اكسيل</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-md-nowrap table-hover" id="example1">
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
                                            <th>الاعدادت</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(($data))
                                            @foreach($data as $info )
                                                <tr class="align-items-center">
                                                    <td><span class="badge badge-success float-left">{{$info->discount_rate->discount_rate}}%</span>{{$info->bill_code}}</td>
                                                    <td>{{$info->bill_date}}</td>
                                                    <td>{{$info->added->name}}</td>
                                                    <td>{{$info->due_date}}</td>
                                                    <td>{{$info->section->section_name}}</td>
                                                    <td>{{$info->product->product_name}}</td>
                                                    <td>{{$info->mount_collection}}</td>
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
                                                        <div class="mb-3 mb-xl-0">
                                                            <div class="btn-group dropdown show">

                                                                <button type="button" class="btn-icon btn btn-outline dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="si si-options"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-left " aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-1px, 40px, 0px);">
                                                                    <a title="عرض تفاصيل الفاتورة" id="billDeL"  data-id="{{$info->id}}" class=" btn-icon btn btn-outline-secondary m-1"
                                                                       data-toggle="modal" data-target="#View" ><i class="typcn typcn-eye-outline"></i></a>
                                                                    <a title="عملية دفع جديدة" id="addDetails" data-id="{{$info->id}}"  class=" btn-icon btn btn-outline-success m-1"
                                                                       data-toggle="modal" data-target="#Details"><i class="typcn typcn-plus-outline"></i></a>
                                                                    <a title="طباعة الفاتورة" href="{{route('billPrint',$info->bill_code)}}"   class=" btn-icon  btn btn-outline-danger m-1"><i class="typcn typcn-printer"></i></a>
                                                                    <a title="نعديل الفاتورة" href="{{route('billEdit',$info->bill_code)}}"  class=" btn-icon btn btn-outline-success m-1"><i class="typcn typcn-edit"></i></a>
                                                                    <a title="ارشفة الفاتورة" id="Delete"  data-bill_id="{{$info->id}}" class=" btn-icon  btn btn-outline-dark m-1" data-toggle="modal" data-target="#Archive"><i class="typcn typcn-archive"></i></a>
                                                                    <a title="حذف الفاتورة" id="Delete"  data-bill_id="{{$info->id}}" class=" btn-icon  btn btn-outline-danger m-1" data-toggle="modal" data-target="#Delete"><i class="typcn typcn-delete-outline"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        @include('bills.details')
                                        @include('layouts.models')
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
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

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
                        $('.viewDetails').html(data)
                    },
                    error:function (){
                        $('.modal').html('<h5 style="color:red">عفوا لا يوجد بيانات لعرضها</h5>')
                    }

                })

            })

            $(document).on('click','#addDetails',function (){
                var addDetails = $(this).data('id');
                jQuery.ajax({
                    url:'{{route('billAjax')}}',
                    type:'post',
                    "dataType":"html",
                    cache:false,
                    data:{'_token':'{{csrf_token()}}' , addDetails },
                    success:function (data){
                        $('.viewDetails').html(data)
                    },
                    error:function (){
                        $('.modal').html('<h5 style="color:red">عفوا لا يوجد بيانات لعرضها</h5>')
                    }

                })

            })

            $(document).on('click','#deleteAttachment',function (){
                var chk = confirm('هل انت متاكد من حذف ملحق')
                if(!chk){
                    return false;
                }
            })

            $(document).on('click','#Delete',function (){
                var id = $(this).data('bill_id')
                $('#deleteSubmit').val(id)
            })

            $(document).on('click','#deleteSubmit',function (){
                var id = $(this).val()
                location.href='{{route('billToArchive')}}' + '/' + id;
            })






        })
    </script>
@endsection
