@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---Internal  Owl Carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <!--- Internal Sweet-Alert css-->
    <link href="{{URL::asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ القائمة</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <a class="tx-12 tx-gray-500 mb-2 btn btn-outline-secondary float-left" data-target="#modaldemo3" data-toggle="modal" href=""><i class="fa fa-plus"></i></a>
            <div id="modelBody">@include('products.add')</div>
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
                    <div class="table-responsive table-center">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0" style="width:12%">الأسم</th>
                                <th class="wd-15p border-bottom-0">الوصف</th>
                                <th class="wd-15p border-bottom-0" style="width:10%">القسم</th>
                                <th class="wd-20p border-bottom-0" style="width:10%" >الحاله</th>
                                <th class="wd-15p border-bottom-0">الادمن الذي اضاف</th>
                                <th class="wd-10p border-bottom-0">اخر تعديل</th>
                                <th class="wd-25p border-bottom-0">الاعدادت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($data)
                                @foreach($data as $info)
                                    <tr>
                                        <td>{{$info->product_name}}</td>
                                        <td>
                                            @if(isset($info->description))
                                                {{$info->description}}
                                            @else
                                                لا يوجد وصف
                                            @endif
                                        </td>
                                        <td>{{$info->section->section_name}}</td>
                                        <td class="{{$info->status == 1 ? 'bg-success' : 'bg-danger'}}">
                                            {{$info->status == 1 ? 'مفعل' : 'غير مفعل'}}
                                        </td>
                                        <td>@php $gd = new DateTime($info->crated_at);
                                               $date = $gd ->format('Y:m:d');
                                            @endphp
                                                 {{$date}}  <br>  بواسطة {{$info->added->username}}
                                        <td>
                                            @if(isset($info->updated_by))
                                                @php $gd = new DateTime($info->updated_at);
                                               $date = $gd ->format('Y:m:d');
                                                @endphp
                                                {{$date}}  <br>  بواسطة {{$info->edit_by->username}}
                                            @else
                                                لم تحدث بعد الاضافة
                                            @endif
                                        </td>

                                        <td>
                                            <div class="row">
                                                @if($info->status == 1)
                                                    <a  href="{{route('productActive',$info->id)}}" class="col-md-3 btn-icon btn btn-outline-danger m-1" ><i class="typcn typcn-lock-closed-outline"></i></a>
                                                @else
                                                    <a  href="{{route('productActive',$info->id)}}" class="col-md-3 btn-icon btn btn-outline-success m-1" ><i class="typcn typcn-lock-open-outline"></i></a>
                                                @endif

                                                <a id="Edit" data-id="{{$info->id}}"  class="col-md-3 btn-icon btn btn-outline-danger m-1" data-target="#modaldemo3" data-toggle="modal" href=""><i class="typcn typcn-edit"></i></a>

                                                <a  class="col-md-3 btn-icon btn btn-outline-danger m-1" id='swal-parameter' ><i class="typcn typcn-delete-outline"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
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
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/rating/ratings.js')}}"></script>
    <!--Internal  Sweet-Alert js-->
    <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>
    <!-- Sweet-alert js  -->
    <script src="{{URL::asset('assets/js/sweet-alert.js')}}"></script>
    <script>
        $(document).ready(function (){
            $(document).on('click','#Edit',function (){
                    var value = $(this).data('id');
                    jQuery.ajax({
                        url:'{{route('productAjax')}}',
                        type:'post',
                        'dataType':'html',
                        cache:false,
                        data:{'_token':'{{csrf_token()}}',value},
                        success:function (data){
                            $('.modal').html(data);
                        },
                        error:function (){

                        }
                    })
            })
            $(document).on('click','.confirm',function (){
                var id = $('#swal-parameter').data('id');
                $('#swal-parameter').attr('href','{{route('productDelete' , $id = 1)}}')
            })

        })
    </script>
@endsection
