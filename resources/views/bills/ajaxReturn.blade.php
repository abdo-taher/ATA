
@if($type == 'product')

@foreach ($data as $info)
    <option value="{{$info->id}}">{{$info->product_name}}</option>
@endforeach
@endif

@if($type == 'addDetails')
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <form action="{{ route('paymentUpdate',$id) }}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة عملية دفع جديدة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

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
                        </div>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary " type="submit" value="حفظ بيانات الدفع">
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">غلق </button>
                </div>
            </form>
        </div>
    </div>
@endif

@if($type == 'details')


<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
            <h6 class="modal-title">تفاصيل فاتورة ({{$data['key_details']->bill_code}})</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="example">
                <div class="panel panel-primary tabs-style-3">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu ">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li><a href="#Key_details" data-toggle="tab" class="active"><i class="fa fa-cogs"></i> تفاصيل الفاتورة</a></li>
                                <li><a href="#Payment_cases" data-toggle="tab" class=""><i class="fa fa-cube"></i> تفاصيل الدفع</a></li>
                                <li><a href="#Attachments" data-toggle="tab" class=""><i class="fa fa-tasks"></i> ملحقات الفاتورة</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                                <div class="tab-pane active" id="Key_details">
                                    <div class="list-group table-hover">
                                        <div class="list-group-item border-top-0">
                                            <p>رقم الفاتورة</p><span>{{$data['key_details']->bill_code}}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>تاريخ الاصدار</p><span>{{$data['key_details']->bill_date}}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>القسم</p><span>{{$data['key_details']->section->section_name}}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>المنتج</p><span>{{$data['key_details']->product->product_name}}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>مبلغ التحصيل</p><span>{{$data['key_details']->mount_collection}}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>مبلغ العمولة</p><span>{{$data['key_details']->mount_commission}}</span>
                                        </div>
                                        <div class="list-group-item border-bottom-0 mb-0">
                                            <p>الخصم</p><span>{{$data['key_details']->discount}}</span>
                                        </div>
                                        <div class="list-group-item border-bottom-0 mb-0">
                                            <p>نسبة الضريبة</p><span>{{$data['key_details']->value_vat}}</span>
                                        </div>
                                        <div class="list-group-item border-bottom-0 mb-0">
                                            <p>نسبة الضريبة</p><span>{{$data['key_details']->discount_rate->discount_rate}}%</span>
                                        </div>
                                        <div class="list-group-item border-bottom-0 mb-0">
                                            <p>الاجمالي مع الضريبة</p><span>{{$data['key_details']->total}}</span>
                                        </div>
                                        <div class="list-group-item border-bottom-0 mb-0">
                                            <p>ملاحظات</p><span>{{$data['key_details']->note}}</span>
                                        </div>
                                        <div class="list-group-item border-bottom-0 mb-0">
                                            <p>حالة الفاتورة</p><span class="
                                                @if($data['key_details']->status->id == 2)
                                                bg-danger-transparent
                                                @elseif($data['key_details']->status->id == 1)
                                                bg-success-transparent
                                                @else
                                                bg-secondary
                                                @endif
                                                ">{{$data['key_details']->status->status_name}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="Payment_cases">

                                    <div class="example">
                                        <div class="panel panel-primary tabs-style-3">
                                            <div class="tab-menu-heading">
                                                <div class="tabs-menu ">
                                                    <!-- Tabs -->
                                                    <ul class="nav panel-tabs">
                                                        @foreach($data['Payment_cases'] as $key => $info )
                                                        <li><a href="#Key_{{$key}}" data-toggle="tab" class="
                                                                @if($info->status->id == 2)
                                                                bg-danger
                                                                @elseif($info->status->id == 1)
                                                                bg-success
                                                                @else
                                                                bg-secondary
                                                                @endif
                                                                @if($key == 0)
                                                                active
                                                                @endif
                                                                ">
                                                                <i>{{$info->status->status_name}}</i></a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="panel-body tabs-menu-body">
                                                <div class="tab-content">
                                                @foreach($data['Payment_cases'] as $key => $info )
                                                    <div class="tab-pane {{$key == 0 ? 'active' : ''}}" id="Key_{{$key}}">
                                                        <div class="list-group-item border-top-0">
                                                            <p>رقم الفاتورة</p><span>{{$info->bill_code}}</span>
                                                        </div>
                                                        @if(isset($info->payment_total))
                                                        <div class="list-group-item">
                                                            <p>اجمالي الدفع</p>
                                                            <span>
                                                                {{$info->payment_total}}
                                                            </span>
                                                        </div>
                                                        @endif
                                                        <div class="list-group-item">
                                                            <p>تاريخ الدفع</p>
                                                            <span>
                                                                @if(isset($info->payment_date))
                                                                    {{$info->payment_date}}
                                                                @else
                                                                    الفاتورة مازاالت غير مدفوعه
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="list-group-item">
                                                            <p>القسم</p><span>{{$info->section->section_name}}</span>
                                                        </div>
                                                        <div class="list-group-item">
                                                            <p>المنتج</p><span>{{$info->product->product_name}}</span>
                                                        </div>
                                                        <div class="list-group-item">
                                                            <p>الملاحظات</p>
                                                            <span>
                                                                @if(isset($info->note))
                                                                    {{$info->note}}
                                                                @else
                                                                    لا يوجد ملاحظات
                                                                @endif
                                                             </span>
                                                        </div>
                                                        <div class="list-group-item">
                                                            <p>الادمن الذي اضاف الفاتورة</p><span>{{$info->added->name}}</span>
                                                        </div>
                                                        <div class="list-group-item">
                                                            <p>تاريخ انشاء الفاتورة</p><span>{{$info->created_at}}</span>
                                                        </div>
                                                        <div class="list-group-item">
                                                            <p>اخر تعديل</p>
                                                            <span>
                                                                @if(isset($info->updatedd->name))
                                                                    {{$info->updatedd->name}}
                                                                @else
                                                                    لا يوجد تعديلات الي الان
                                                                @endif
                                                        </span>
                                                        </div>
                                                        <div class="list-group-item">
                                                            <p>تاريخ اخر تعديل</p>
                                                            <span>
                                                                @if(isset($info->updated_at))
                                                                    {{$info->updated_at}}
                                                                @else
                                                                    لا يوجد تعديلات الي الان
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane" id="Attachments">
                        <div>
                            @can('اضافة مرفق')
                            <h5 class="card-title">اضف مرفق جديد</h5>
                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                            <br>
                            <form action="{{route('storeBillAttachment')}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <input id="attachment_file" class="btn btn-outline-primary dropify" type="file" name="file_name" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                            <input type="hidden" name="bill_id" value="{{$data['key_details']->id}}">
                            <input type="hidden" name="bill_code" value="{{$data['key_details']->bill_code}}">
                                <br>
                                <br>
                            <input id="attachment_submit" type="submit"  class="btn btn-outline-primary justify-content-center" value="حفظ المرفق">
                            </form>
                            @endcan
                        </div>
                        <br>
                        <table class="table-hover table">
                            <tr>
                                <th>اسم الملحق</th>
                                <th>الاعدادات</th>
                            </tr>
                            @foreach($data['Attachments'] as $info)
                            <tr>
                                <td id="bill_code">{{$info->file_name}}</td>
                                <td class="row">
                                    <a title="عرض الملحق" href="{{asset('assets/img/billFiles' . "/" . $info->bill_code . "/" . $info->file_name)}}" class="col-md-3 btn-icon btn btn-outline-secondary m-1" target="_blank"><i class="typcn typcn-eye-outline"></i></a>
                                    <a title="تحميل الملحق"  href="{{asset('assets/img/billFiles' . "/" . $info->bill_code . "/" . $info->file_name)}}" class="col-md-3 btn-icon btn btn-outline-success m-1" download><i class="typcn typcn-arrow-down-thick"></i></a>
                                    @can('حذف المرفق')
                                    <a title="حذف الملحق" href="{{route('deleteAttachment',$info->id)}}" id="deleteAttachment"  class="col-md-3 btn-icon  btn btn-outline-danger m-1" data-bill_id="{{$info->id}}"><i class="typcn typcn-delete-outline"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">غلق </button>
        </div>
    </div>
</div>


@endif
