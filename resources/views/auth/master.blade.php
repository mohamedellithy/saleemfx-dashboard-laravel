@extends('master')

@push('css')
    <style>
        .main-sidebar{
            display:none;
        }
        .content-wrapper{
            margin-right:0px !important;
            background-image:url("{{ asset('images/forex.png') }}");
            background-size: cover;
        }
        .card{
             background-color: transparent !important;
        }
        .login-button{
            width: 75%;
            margin: auto;
            display: block !important;
            font-size: 19px !important;
            font-weight: bold !important;
        }
        .btn-link-rememebr-password{
            margin: auto;
            display: block !important;
            color: white !important;
            font-size: 16px !important;
            font-weight: bolder !important;
        }
        .card-header-login{
            font-weight: bolder;
            font-size: 30px;
            text-align: center;
            color: #f0ba12;

        }
        input {
            text-align: center;
        }

        ::-webkit-input-placeholder {
            text-align: center;
        }

        :-moz-placeholder {
            text-align: center;
        }
        .title-forex-login{
            margin-top: 18%;
            text-align: center;
            background-color: #2f2e2eb5;
        }
        .title-forex-login h3{
            font-size: 31px;
            line-height: 2em;
            margin: auto;
            color: #e1b223;
            font-weight: bolder;
            margin-bottom: 14%;
        }
        .brand-name-dashboard{
            width: 72px;
        }
        .brand-name-dashboard .logo-dashboard {
            width: 100%;
        }
        .navbar-light .navbar-nav .nav-link{
            display: none;
        }

        .navbar-nav>.user-menu>.dropdown-menu>.user-body {
            border-bottom: 1px solid #dedede;
            border-top: 1px solid #dee2e6;
            padding: 9px 4px;
        }

        .navbar-nav>.user-menu>.dropdown-menu>.user-footer .btn-default {
            text-align: right;
        }

        .navbar-nav>.user-menu>.dropdown-menu>.user-footer {
            padding: 3px 10px;
        }

        .navbar-nav>.user-menu>.dropdown-menu>.user-footer .btn-default {
            color: #17a2b8;
        }

        .login-register-item {
            float: left;
            border: 2px solid #f0ba12;
            border-radius: 7px;
            padding: 8px;
            margin: 0px 10px;
            font-size: 16px;
        }

        .dashboard-name-menu {
            display: inline-block;
        }

        .menu-items {
            display: block !important;
            width: 100%;
        }

        .navbar-expand .navbar-nav {
            width: 100%;
            display: contents;
        }
        .card{
            border: 0px !important;
            box-shadow: 0px 0px 0px 0px;
        }
        .card-header
        {
            border-bottom: 0px solid rgba(0,0,0,.125) !important;
        }

        body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper, 
        body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer, 
        body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header{
            margin-left: 0px;
        }

    </style>
@endpush


@section('content_header')
   <script src="//code.tidio.co/8gymtjkfn2j8zfkjnelcojeyywgdathr.js" async></script>

@stop

@section('content_top_nav_left')
    <li class="brand-name-dashboard">
       <a href="#">
          <img class="logo-dashboard" src="{{ asset('images/social11.png')}}" >
       </a>
    </li>


    <x-menu-items></x-menu-items>
    <x-mobile-menu></x-mobile-menu>





    @if(!auth()->user())
          <!-- mobile -->
        <li class="dashboard-name-menu login-register-item mobile">
            <a href="{{ route('login') }}">  تسجيل الدخول </a>
        </li>
        <li class="dashboard-name-menu login-register-item mobile">
            <a href="{{ route('register') }}">  انشاء حساب </a>
        </li>

    @endif
@endsection
