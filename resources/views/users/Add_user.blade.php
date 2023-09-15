@extends('layouts.master')
@section('css')
    <!-- Internal Nice-select css  -->
    <link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
@section('title')
    اضافة مستخدم - مورا سوفت للادارة القانونية
@stop


@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة
                مستخدم</span>
            </div>

        </div>
        <div class="float-left">
            <a class="btn btn-dark" href="{{ route('Users.index') }}"><span><i class="float-left fa fa-arrow-left"></i></span></a>

        </div>
    </div>

    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">


        <div class="col-lg-12 col-md-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>خطا</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">

                        </div>
                    </div><br>
                    <form class="parsley-style-1" id="selectForm2" enctype="multipart/form-data" autocomplete="off" name="selectForm2"
                          action="{{route('Users.store')}}" method="post">
                        {{csrf_field()}}

                        <div class="">

                            <div class="row mg-b-20">
                                <div class="parsley-input col-md-6" id="fnWrapper">
                                    <label>الاسم ثلاثي: </label>
                                    <input class="form-control form-control-sm mg-b-20" value="{{old('name')}}"
                                           data-parsley-class-handler="#lnWrapper" name="name" required="" type="text">
                                </div>

                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <label>البريد الالكتروني: </label>
                                    <input class="form-control form-control-sm mg-b-20" value="{{old('email')}}"
                                           data-parsley-class-handler="#lnWrapper" name="email" required="" type="email">
                                </div>
                            </div>

                        </div>
                        <div class="row row-sm mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>اسم المستخدم: </label>
                                <input class="form-control form-control-sm mg-b-20" value="{{old('username')}}"
                                       data-parsley-class-handler="#lnWrapper" name="username" required="" type="text">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">حالة المستخدم</label>
                                <select name="status" id="select-beast" class="form-control  nice-select  custom-select">
                                    <option {{old('status') == 1 ? 'selected' : ''}} value="1">مفعل</option>
                                    <option {{old('status') == 0 ? 'selected' : ''}} value="0">غير مفعل</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>كلمة المرور: </label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper" value="{{old('password')}}"
                                       name="password" required="" type="password">
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label> تاكيد كلمة المرور: </label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                       name="confirm-password" required="" type="password">
                            </div>
                        </div>
                        <div class="row mg-b-20">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label class="form-label"> صلاحية المستخدم</label>
                                    {!! Form::select('role_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-12 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label class="form-label">صورة المستخدم <span class="tx-danger">*</span> صيغة المرفق pdf, jpeg ,.jpg , png </label>
                                <input type="file" name="image" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-main-primary pd-x-20" type="submit">تاكيد</button>
                        </div>
                    </form>
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


    <!-- Internal Nice-select js-->
    <script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

    <!--Internal  Parsley.min js -->
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
@endsection
