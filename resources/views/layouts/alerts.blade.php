

@if (session()->has('success'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{Session::get('success')}}",
                type: "success"
            })
        }

    </script>
@endif
@if (session()->has('fail'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{Session::get('fail')}}",
                type: "error"
            })
        }

    </script>
@endif
@error('file_name')
<script>
    window.onload = function() {
        notif({
            msg: "{{$message}}",
            type: "error"
        })
    }

</script>
@enderror
@error('payment_total')
<script>
    window.onload = function() {
        notif({
            msg: "{{$message}}",
            type: "error"
        })
    }

</script>
@enderror
