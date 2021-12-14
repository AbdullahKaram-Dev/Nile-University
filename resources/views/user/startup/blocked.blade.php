<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{__('dashboard.blocked')}}</title>
    <link href="{{asset('user/assets/img/favicon.ico')}}" rel="icon" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('user/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/assets/css/pages/error/style-500.css')}}" rel="stylesheet" type="text/css" />

</head>
<body class="error500 text-center">


<div class="container-fluid error-content">
    <div class="">
        <p class="mini-text">Ooops !</p>
        <h1 class="mini-tex">{{__('dashboard.your_account_has_been_suspended_please_contact_the_administrator')}}</h1>
        <a href="{{route('web.site.home')}}" class="btn btn-secondary mt-5">{{__('dashboard.go_back')}}</a>
        <a href="{{route('logout')}}" class="btn btn-secondary mt-5">{{__('dashboard.logout')}}</a>
    </div>
</div>


<script src="{{asset('user/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('user/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('user/bootstrap/js/bootstrap.min.js')}}"></script>

</body>
</html>
