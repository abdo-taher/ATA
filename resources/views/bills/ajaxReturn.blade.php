
@if($type == 'product')
<option value="" selected disabled>حدد المنتج</option>
@foreach ($data as $info)
    <option value="{{$info->id}}">{{$info->product_name}}</option>
@endforeach
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
                                            </div><div class="list-group-item border-bottom-0 mb-0">
                                                <p>نسبة الضريبة</p><span>{{$data['key_details']->discount}}</span>
                                            </div><div class="list-group-item border-bottom-0 mb-0">
                                                <p>نسبة الضريبة</p><span>{{$data['key_details']->discount_rate->discount_rate}}%</span>
                                            </div><div class="list-group-item border-bottom-0 mb-0">
                                                <p>الاجمالي مع الضريبة</p><span>{{$data['key_details']->value_vat}}</span>
                                            </div><div class="list-group-item border-bottom-0 mb-0">
                                                <p>ملاحظات</p><span>{{$data['key_details']->total}}</span>
                                            </div><div class="list-group-item border-bottom-0 mb-0">
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
                                        <div class="list-group-item border-top-0">
                                            <p>حالة الفاتورة</p>
                                            <span class="
                                                @if($data['Payment_cases']->status->id == 2)
                                                badge badge-danger
                                                @elseif($data['Payment_cases']->status->id == 1)
                                                badge badge-success
                                                @else
                                                badge badge-secondary
                                                @endif
                                                ">{{$data['Payment_cases']->status->status_name}}
                                            </span>
                                        </div>
                                        <div class="list-group-item border-top-0">
                                            <p>رقم الفاتورة</p><span>{{$data['Payment_cases']->bill_code}}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>تاريخ الاصدار</p>
                                            <span>
                                                @if(isset($data['Payment_cases']->payment_date))
                                                    {{$data['Payment_cases']->payment_date}}
                                                @else
                                                    الفاتورة مازاالت غير مدفوعه
                                                @endif
                                            </span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>القسم</p><span>{{$data['Payment_cases']->section->section_name}}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>المنتج</p><span>{{$data['Payment_cases']->product->product_name}}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>الملاحظات</p>
                                            <span>
                                                @if(isset($data['Payment_cases']->note))
                                                    {{$data['Payment_cases']->note}}
                                                @else
                                                    لا يوجد ملاحظات
                                                @endif
                                            </span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>الادمن الذي اضاف الفاتورة</p><span>{{$data['Payment_cases']->added->name}}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>تاريخ انشاء الفاتورة</p><span>{{$data['Payment_cases']->created_at}}</span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>اخر تعديل</p>
                                            <span>
                                                @if(isset($data['Payment_cases']->updated_by))
                                                {{$data['Payment_cases']->updated_by->name}}
                                                @else
                                                    لا يوجد تعديلات الي الان
                                                @endif
                                            </span>
                                        </div>
                                        <div class="list-group-item">
                                            <p>تاريخ اخر تعديل</p>
                                            <span>
                                                @if(isset($data['Payment_cases']->updated_at))
                                                    {{$data['Payment_cases']->updated_at}}
                                                @else
                                                    لا يوجد تعديلات الي الان
                                                @endif
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="Attachments">

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
