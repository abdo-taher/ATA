@extends('layouts.master')
@section('title')
أرشيف الفواتير
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
							<h4 class="content-title mb-0 my-auto">ارشيف الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ القائمة</span>
						</div>
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
                                <div class="table-responsive">
                                    <table class="table text-md-nowrap table-hover" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p border-bottom-0">رقم الفاتورة</th>
                                            <th class="wd-15p border-bottom-0">تاريخ الاصدار</th>
                                            <th class="wd-10p border-bottom-0">الادمن الذي اضافها</th>
                                            <th class="wd-15p border-bottom-0">تاريخ الاستحقاق</th>
                                            <th class="wd-10p border-bottom-0">القسم</th>
                                            <th class="wd-10p border-bottom-0">المنتج</th>
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
                                                            <a title="ارجاع الفاتورة" href="{{route('billRestore',$info->id)}}"  class="col-md-3 btn-icon btn btn-outline-success m-1"><i class="typcn typcn-archive"></i></a>
                                                            <a title="حذف الفاتورة نهائيا" id="Delete"  data-bill_id="{{$info->id}}" class="col-md-3 btn-icon  btn btn-outline-danger m-1" data-toggle="modal" data-target="#Delete"><i class="typcn typcn-delete-outline"></i></a>
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
            $(document).on('click','#deleteSubmitAttach',function (){
                var  billCode = $('#bill_code').val()
                var chk = confirm('هل انت متاكد من حذف ملحق'+billCode)
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
                location.href='{{route('forceDelete')}}' + '/' + id;
            })




        })
    </script>
@endsection
