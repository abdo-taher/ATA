
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل {{$data->section_name}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{route('sectionUpdate',$data->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>اسم القسم</label>
                        <input type="text" class="form-control" name="section_name" id="inputName" value="{{$data->section_name}}">
                    </div>
                    <div class="form-group">
                        <label>وصف القسم</label>
                        <textarea class="form-control" name="description">{{$data->description}}</textarea>
                    </div>
                    <div class="form-group mb-0 mt-3 justify-content-end">
                        <div>
                            <input type="submit" class="btn btn-primary" value="تعديل">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">غلق </button>
            </div>
        </div>
    </div>

