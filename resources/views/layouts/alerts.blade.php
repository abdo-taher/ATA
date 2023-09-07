


@if (Session::has('success'))
    <div class="alert alert-outline-success" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span></button>
        <strong>نجاح العملية!</strong> {{Session::get('success')}}
    </div>
@endif
@if (Session::has('fail'))
    <div class="alert alert-outline-danger" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span></button>
        <strong>فشل العملية!</strong> {{Session::get('fail')}}
    </div>
@endif
