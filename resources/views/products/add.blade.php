
<div class="modal" id="modaldemo3">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">إضافة منتج جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="addForm" class="form-horizontal" action="{{route('productStore')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>نوع القسم</label>
                        <div class="SumoSelect sumo_somename" tabindex="0" role="button" aria-expanded="true">
                            <select name="section_id" class="form-control SlectBox SumoUnder"  tabindex="-1">
                                <!--placeholder-->
                                @foreach($section as $info)
                                    <option value="{{$info->id}}">{{$info->section_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>اسم المنتج</label>
                        <input type="text" class="form-control" name="product_name" id="inputName" placeholder="ادخل الاسم">
                    </div>
                    <div class="form-group">
                        <label>وصف المنتج</label>
                        <textarea class="form-control" name="description" placeholder="ادخل الوصف"></textarea>
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <input type="submit" class="btn btn-primary" value="أضافة">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">غلق </button>
            </div>
        </div>
    </div>
</div>
