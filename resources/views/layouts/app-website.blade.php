<!DOCTYPE html>
<html lang="{{LaravelLocalization::getCurrentLocale()}}" dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- FontAwsome -->
    <link rel="stylesheet" href="{{asset('front/css/all.min.css')}}">
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <!-- Videos Plugin -->
    <link rel="stylesheet" href="{{asset('front/css/lity.min.css')}}">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <!-- <link rel="stylesheet" href="assets/css/style-en.css"> -->
    <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @toastr_css
    @yield('css')
</head>
<body>

    <x-pre-loader></x-pre-loader>
    <x-nav-bar></x-nav-bar>

    <x-modal-login-register></x-modal-login-register>



    @yield('content')

    <x-main-banner></x-main-banner>
    <x-footer-component></x-footer-component>



    <script src="{{asset('front/js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('front/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('front/js/lity.min.js')}}"></script>
    <script src="{{asset('front/js/main.js')}}"></script>
    @toastr_js
    @toastr_render
    @yield('scripts')
  </body>
</html>
