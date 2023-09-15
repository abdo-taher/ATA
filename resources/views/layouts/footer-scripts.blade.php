<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('assets/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{URL::asset('assets/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{URL::asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{URL::asset('assets/js/eva-icons.min.js')}}"></script>
@yield('js')
<!-- Sticky js -->
<script src="{{URL::asset('assets/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('assets/plugins/side-menu/sidemenu.js')}}"></script>


<script>
    $(document).ready(function () {
        $(document).on('click', '#veiwBill', function () {
            var id = $(this).data('id');
            $(this).addClass('asRead');
            jQuery.ajax({
                url: '{{route('billAjax')}}',
                type: 'post',
                "dataType": "html",
                cache: false,
                data: {'_token': '{{csrf_token()}}', id},
                success: function (data) {
                    $('.viewDetails').html(data)
                },
                error: function () {
                    $('.modal').html('<h5 style="color:red">عفوا لا يوجد بيانات لعرضها</h5>')
                }

            })

        })
        $(document).on('click','#exit',function (){
            var id = $('.asRead').data('notifay')
            if (id != undefined){
                location.href='{{route('billRead')}}' + '/' + id;
            }


        })
        // setInterval(function (){
        //     $("#notification1").load(window.location.href + "#notification1");
        //     $("#notification2").load(window.location.href + "#notification2");
        //     $("#notification3").load(window.location.href + "#notification3");
        // },5000)
    })
</script>
