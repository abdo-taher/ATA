@extends('layouts.master')
@section('title')
     تعديل فاتورة
@endsection
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير /</span><span id="breadcrumbName" class="text-muted mt-1 tx-13 mr-2 mb-0">تعديل بيانات اساسية</span>
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
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="example">
                    <div class="panel panel-primary tabs-style-2">
                        <div class=" tab-menu-heading">
                            <div class="tabs-menu1">
                                <div class="float-left">
                                    <p class="text-danger">بيانات الدفع ليست ضمن البيانات الاساسية</p>
                                </div>
                                <!-- Tabs -->
                                <ul class="nav panel-tabs main-nav-line">
                                    <li><a href="#mainEdit" id="nav" class="nav-link active" data-toggle="tab">تعديل بيانات اساسية</a></li>
                                    <li><a href="#reguEdit" id="nav" class="nav-link" data-toggle="tab">تعديل بيانات الدفع</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body main-content-body-right border">
                            <div class="tab-content">
                                <div class="tab-pane active" id="mainEdit">
                                    <div class="card-body">
                                        <form action="{{ route('billUpdate',$data->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            {{-- 1 --}}
                                            <div class="row">
                                                <div class="col">
                                                    <label for="inputName" class="control-label">رقم الفاتورة</label>
                                                    <input type="number" class="form-control" id="inputName" name="bill_code" title="يرجي ادخال رقم الفاتورة" value="{{$data->bill_code}}" readonly>
                                                    @error('bill_code')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>


                                                <div class="col">
                                                    <label>تاريخ الفاتورة</label>
                                                    <input class="form-control " name="bill_date" placeholder="YYYY-MM-DD" type="date" value="{{$data->bill_date}}"   required>
                                                    @error('bill_date')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col">
                                                    <label>تاريخ الاستحقاق</label>
                                                    <input class="form-control " name="due_date" placeholder="YYYY-MM-DD" type="date" value="{{$data->due_date}}" required>
                                                    @error('due_date')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>

                                            {{-- 2 --}}
                                            <div class="row">
                                                <div class="col">
                                                    <label for="inputName" class="control-label">القسم</label>
                                                    <select name="section_id" class="form-control SlectBox" id="Section">
                                                        <!--placeholder-->
                                                        <option value="" selected disabled>حدد القسم</option>
                                                        @foreach ($sections as $info)
                                                            <option {{ $data->section_id == $info->id ? "selected" : ""}} value="{{ $info->id }}"> {{ $info->section_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('section_id')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col">
                                                    <label for="inputName" class="control-label">المنتج</label>
                                                    <select id="product" name="product_id" class="form-control">
                                                        @foreach ($product as $info)
                                                            <option {{$data->product_id == $info->id ? "selected" : "disabled"}} value="{{ $info->id }}"> {{ $info->product_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('product_id')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col">
                                                    <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                                    <input type="number" class="form-control" id="Mount_Collection" name="mount_collection" value="{{$data->mount_collection}}"
                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                    @error('mount_collection')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            {{-- 3 --}}

                                            <div class="row">

                                                <div class="col">
                                                    <label for="inputName" class="control-label">مبلغ العمولة</label>
                                                    <input type="number" class="form-control form-control-lg" id="Mount_Commission" value="{{$data->mount_commission}}"
                                                           name="mount_commission" title="يرجي ادخال مبلغ العمولة " required
                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                    @error('mount_commission')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col">
                                                    <label for="inputName" class="control-label">الخصم</label>
                                                    <input type="number" class="form-control form-control-lg" id="Discount" name="discount" value="{{$data->discount >= 1  ? $data->discount : 0}}"
                                                           title="يرجي ادخال مبلغ الخصم "  required
                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                    @error('discount')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col">
                                                    <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                                    <select name="discount_rate_id" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                                        <!--placeholder-->
                                                        <option value="discount_rate_id" selected disabled>حدد نسبة الضريبة</option>
                                                        @foreach ($tax_rate as $info)
                                                            <option {{$data->discount_rate_id == $info->id ? "selected" : ""}} value="{{ $info->id }}"> {{ $info->discount_rate }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('discount_rate_id')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>

                                            {{-- 4 --}}

                                            <div class="row">
                                                <div class="col">
                                                    <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                                    <input type="number" class="form-control" id="Value_VAT" name="value_vat" value="{{$data->value_vat}}" readonly>
                                                    @error('value_vat')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="col">
                                                    <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                                    <input type="number" class="form-control" id="Total" name="total" value="{{$data->total}}" readonly>
                                                    @error('total')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- 5 --}}
                                            <div class="row">
                                                <div class="col">
                                                    <label for="exampleTextarea">ملاحظات</label>
                                                    <textarea class="form-control" id="exampleTextarea" name="note" rows="3">{{$data->note}}</textarea>
                                                    @error('note')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div><br>

                                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                            <h5 class="card-title">المرفقات</h5>

                                            <div class="col-sm-12 col-md-12">
                                                <input type="file" name="file_name" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png" value="{{$file_name->file_name}}"
                                                       data-height="70" />
                                                @if(isset($file_name->file_name))
                                                    <img src="{{asset('assets/img/billFile')."/".$data->bill_code}}" data-height="70" class="dropify">
                                                @endif
                                                @error('file_name')
                                                <div class="alert alert-outline-danger" role="alert">
                                                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                        <span aria-hidden="true">×</span></button>
                                                    <strong>خطأ!</strong>{{$message}}
                                                </div>
                                                @enderror
                                            </div><br>

                                            <div class="d-flex justify-content-center">
                                                <input class="btn btn-primary" type="submit" value="حفظ البيانات">
                                            </div>


                                        </form>
                                    </div>
                                </div>

                                <div class="tab-pane" id="reguEdit">
                                    <div class="card-body">
                                        <form action="{{ route('paymentUpdate',$data->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            {{-- 1 --}}
                                            <div class="row">
                                                <div class="col">
                                                    <label>تاريخ الدفع</label>
                                                    <input class="form-control " name="payment_date" placeholder="YYYY-MM-DD" type="date" value="{{date('Y-m-d')}}" required>
                                                    @error('payment_date')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>


                                                <div class="col">
                                                    <label for="inputName" class="control-label">مبلغ الدفع</label>
                                                    <input type="number" class="form-control" id="payment_total" name="payment_total" placeholder="ادخل المبلغ التي تم دفعة من الفاتورة"
                                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                    @error('payment_total')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="exampleTextarea">ملاحظات</label>
                                                    <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                                                    @error('note')
                                                    <div class="alert alert-outline-danger" role="alert">
                                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                            <span aria-hidden="true">×</span></button>
                                                        <strong>خطأ!</strong>{{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                                <br>
                                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                            <h5 class="card-title"> المرفقات للدفع</h5>

                                            <div class="col-sm-12 col-md-12">
                                                <input type="file" name="file_name" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                                @error('file_name')
                                                <div class="alert alert-outline-danger" role="alert">
                                                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                                        <span aria-hidden="true">×</span></button>
                                                    <strong>خطأ!</strong>{{$message}}
                                                </div>
                                                @enderror
                                            </div><br>

                                            <div class="d-flex justify-content-center">
                                                <input class="btn btn-primary" type="submit" value="حفظ بيانات الدفع">
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>

        $(document).ready(function (){

            $(document).on('click','#nav',function (){
                var name  =  $(this).html()
                    $('#breadcrumbName').html(name)
            })

            $(document).on('change','#Section', function (){
                var product = $(this).val();
                jQuery.ajax({
                    url:'{{route('billAjax')}}',
                    type:'post',
                    'dataType':'html',
                    cache:false,
                    data:{'_token':'{{csrf_token()}}',product},
                    success:function (data){
                        $('#product').html(data);
                    },
                    error:function (){

                    }
                })
            })
        })
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Mount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }

    </script>
@endsection

