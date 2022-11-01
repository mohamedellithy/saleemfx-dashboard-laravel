@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    Dashboard
@stop

@section('content')
    no content
@stop

@section('usermenu_body')
    @if(auth()->user())
        <a href="{{ auth()->user()->adminlte_profile_url() }}" class="btn btn-default btn-flat">
            <i class="fa fa-fw fa-user"></i>
            الصفحة الشخصية
        </a>
    @endif
    @if(auth()->user() && (!auth()->user()->ifAdmin))
        <script src="//code.tidio.co/8gymtjkfn2j8zfkjnelcojeyywgdathr.js" async></script>
    @endif

@stop

@section('css')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico')}}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- arabic rtl  --}}
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    @endif
    <link rel="stylesheet" href="{{ asset('css/Adminlte-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('js')
    {{-- rtl bootstrap  --}}
    @if(app()->getLocale() == 'ar')
        <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>
    @endif
    <script src="{{ asset('js/admin_custom.js') }}" ></script>
@stop

@push('js')
    <script>
        function FormSubmitDelete(e) {
            e.preventDefault();
            var confirm = window.confirm('هل انت متأكد من حذف هذا العنصر ؟');
            if(confirm == true) {
                e.target.submit();
            }
        }


    </script>
@endpush

@section('content_top_nav_left')
    @auth
        <li class="brand-name-dashboard">
            <a href="#"> مجموعة سليم </a>
        </li>
    @endauth

    @guest
        <li class="brand-name-dashboard">
            <a href="#">
                <img class="logo-dashboard" src="{{ asset('images/social11.png')}}" >
            </a>
        </li>
    @endguest

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

@section('content_top_nav_right')
    @auth
        <li class="toggle-icon-menu-items">
            <span class="fas fa-th-large"></span>
        </li>
    @endauth

    <button class="navbar-toggler toggle-icon-menu-items" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
         <!--<span class="navbar-toggler-icon"></span>-->
         <i class="fas fa-bars"></i>
    </button>

@endsection
