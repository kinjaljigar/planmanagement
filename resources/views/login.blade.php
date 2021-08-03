<!DOCTYPE html>

<html>





<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Sep 2017 12:21:47 GMT -->

<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Login</title>



    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">





    <link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">



    <link href="{{asset('css/animate.css')}}" rel="stylesheet">

    <link href="{{asset('css/style.css')}}" rel="stylesheet">



</head>



<body class="gray-bg">



<div class="middle-box text-center loginscreen animated fadeInDown">

    <div>

        <div>



            {{--<h1 class="logo-name"><img src="{{asset('img/logo.png')}}"/></h1>--}}



        </div>

        <h3>Welcome to Water Management</h3>



        @include('flash-message')



        <form class="m-t" role="form" method="post" action="{{route('checkcredential')}}">

            {{csrf_field()}}

            <div class="form-group">

                <input type="text" name="txt_username" class="form-control" placeholder="Username" required="">

            </div>

            <div class="form-group">

                <input type="password" name="txt_password" class="form-control" placeholder="Password" required="">

            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>



            <a href="#"><small>Forgot password?</small></a>



        </form>



    </div>

</div>



<!-- Mainly scripts -->

<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>



</body>







</html>

