<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    @yield('meta')
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('user/assets/img/favicon.ico')}}"/>
    <link href="{{ asset('user/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('user/assets/js/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('user/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    @toastr_css
    @yield('styles')
</head>

<body>

<!-- BEGIN LOADER -->
@include('user.partials.loader')
<!--  END LOADER -->

<!--  BEGIN NAVBAR  -->
@include('user.partials.first_header')
<!--  END NAVBAR  -->

<!--  BEGIN NAVBAR  -->
@include('user.partials.second_header')
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
@include('user.partials.sidebar')
<!--  END SIDEBAR  -->

    <div id="content" class="main-content">
        <!--  BEGIN CONTENT AREA  -->
    @yield('content')
    <!--  END CONTENT AREA  -->
        @include('user.partials.footer')
    </div>

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('user/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('user/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('user/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('user/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('user/assets/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('user/assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
@jquery
@toastr_js
@toastr_render
@include('user.partials.alert')
@include('user.sounds.sounds')
@include('user.scripts.global.detect-segment')
@yield('scripts')
</body>
</html>
