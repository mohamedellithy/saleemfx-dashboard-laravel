@extends('master')

@section('css')
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/Adminlte-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">

    @guest
        <style>
            .main-sidebar{
                display:none;
            }
            .content-wrapper{
                margin-right:0px !important;
                background-image:none !important;
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
                border: 0px solid rgba(0,0,0,.125) !important;
                box-shadow: none !important;
            }
            .card-header
            {
                border-bottom: 0px solid rgba(0,0,0,.125) !important;
            }
        </style>
    @endguest

@stop

@section('plugins.Sweetalert2', true)

@section('plugins.Select2', true)

@section('content_header')
 تسجيل فى الدورات
@stop


@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(!empty(session('message')))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('message') }}</li>
                </ul>
            </div>
        @endif
        <div class="row">
                <div class="col-lg-6">
                    
                    <div class="card card-primary card-outline">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> التسجيل فى الدورة </h3>
                            </div>
                           
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <form method="post" action="{{ url('courses/store',['course'=>$course->ID]) }}">
                                    @csrf 
                                    <table class="table table-striped">

                                        <tbody>
                                            <tr>
                                                
                                                <td>الاسم الاول</td>
                                                <td>
                                                    <input class="form-control" type="text" name="firstname" value="{{ auth()->user()->firstname ?? '' }}" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td>الاسم الثانى</td>
                                                <td>
                                                    <input class="form-control" type="text" name="lastname" value="{{ auth()->user()->lastname ?? '' }}" required />
                                                </td>
                                            </tr>
                                        
                                            <tr>
                                                
                                                <td>البريدالالكترونى</td>
                                                <td>
                                                    <input class="form-control" type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required/>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                
                                                <td>رقم الجوال</td>
                                                <td>
                                                    <input class="form-control" type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" required/>
                                                </td>
                                            </tr>
                                            <tr>
                                                
                                                <td>رقم حساب التليجرام</td>
                                                <td>
                                                    <input class="form-control" type="tel" name="telegram_number" value="{{ auth()->user()->telegram_number ?? '' }}" />
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                
                                                <td colspan="2">
                                                    <button class="btn btn-success" type="submit" > التسجيل</button>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                                <!-- /.card-body -->
                        </div>
                    </div><!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">تفاصيل الدورة</h3>
                            </div>
                            
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>{!! $course->thumbnail ? '<img style="width: 40%;" src="'.$course->thumbnail.'"/>' : '' !!}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $course->post_title ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                               {!! $course->post_content ?? '' !!} 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>تاريخ اقامة الدورة   {{ $course->post_date ?? '' }}</td>
                                        </tr>
                                       
                                        <tr>
                                            <td>  سعر الدورة    {{ $course->meta->_lp_sale_price ? amount_currency($course->meta->_lp_sale_price) : '( مجانية )'   }}</td>
                                        </tr>
                                        
                                        
                                           
                                    </tbody>
                                </table>
                            </div>
                                <!-- /.card-body -->
                        </div>
                    </div><!-- /.card -->
                </div>
            </div>
        </div>
@stop

@push('js')


    {{-- rtl bootstrap  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>

@endpush


