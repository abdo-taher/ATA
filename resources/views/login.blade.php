<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Page with Background Image Example</title>
  <link rel="stylesheet" href="{{asset('assets/css/login-style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/notify/css/notifIt.css') }}">
</head>
<body dir="rtl">

<div id="bg" style="background-image: url({{asset('assets/img/login/background.jpg')}})"></div>
<!-- partial:index.partial.html -->


<form action="{{route('AdminCheck')}}" method="post" >
    <div id="logoLogin" class="text-center">
        <img class="align-self-center" height="100px" width="100px" src="{{asset('assets/img/logo.png')}}">
    </div>
    @include('layouts.alerts')
  <div class="form-field">
    <input name="username" type="text" placeholder="اسم المتخدم" required/>
  </div>

  <div class="form-field">
    <input name="password" type="password" placeholder="كلمة المرور" required/>
  </div>


  <div class="form-field">
    <button class="btn" type="submit">دخول</button>
  </div>

</form>
<!-- partial -->
<script src="{{asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
</body>
</html>
