@extends('master')

@section('css')
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    @endif
    <link rel="stylesheet" href="{{ asset('css/Adminlte-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">

@stop

@section('plugins.Sweetalert2', true)

@section('plugins.Select2', true)

@section('content_header')
  كاش باك منتهي
@stop


@section('content')
    @if(!auth()->user()->accounts()->where('status',1)->exists())
        <div class="row">
            <div class="container-image-chashback col-md-6 col-xs-12">
                <img src="{{ asset('images/cashback.jpg') }}"/>
                <h2 class="title-image-chashback"> الاسترداد النقدي </h2>
                <p  class="description-image-cachback">
                طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع لتوضيح الشكل المرئي للمستند أو الخط دون الاعتماد على محتوى ذي
                </p>
                @if(!auth()->user()->accounts()->where('status','!=',1)->exists())
                    <button class="btn btn-success create-new-account" data-toggle="modal" data-target="#modal-lg">
                        <i class="fas fa-plus"></i>
                        تفعيل الحساب
                    </button>
                @else
                    <p class="alert alert-info">
                        بانتظار قبول الطلب من المسؤل فى الموقع
                    </p>
                @endif
            </div>
            <x-create-account :companies="$companies"></x-create-account>
        </div>
    @else
        <div class="row">
            <div class="container mt-5">
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
                            <li>{{  session('message') }}</li>
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-warning"><i class="fas fa-wallet"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">اجمالى الرصيد</span>
                                <span class="info-box-number">{{ amount_currency(auth()->user()->total_balance()) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-warning"><i class="fas fa-money-bill"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">اجمالى الكاش باك</span>
                                <span class="info-box-number">{{ amount_currency(auth()->user()->total_cashback()) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-warning"><i class="fas fa-check-circle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"> اجمالى المسحوب</span>
                                <span class="info-box-number">{{ amount_currency(auth()->user()->total_withdraws()) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-warning"><i class="fas fa-check-circle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"> الكاش باك المنتهى</span>
                                <span class="info-box-number">{{ amount_currency(auth()->user()->total_expire_cashbacks()) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-warning"><i class="fas fa-check-circle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"> المتبقي من الكاش باك</span>
                                <span class="info-box-number">{{ amount_currency(auth()->user()->total_cashback_can_withdraw() - auth()->user()->total_expire_cashbacks()) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>

                <h5 class="card-title m-0" style="padding: 11px 1px;"> الكاش باك المنتهي</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> </th>
                            <th> قيمة الكاش باك  </th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(auth()->user()->expire_cashbacks()->get() as $key => $cashback)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ amount_currency($cashback->value) }}</td>
                                <td>{{ $cashback->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"> لايوجد كاش باك منتهي فى حسابك </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    @endif
@stop

@push('js')


    {{-- rtl bootstrap  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    @if(app()->getLocale() == 'ar')
        <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>
    @endif
    <script>
        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 30000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        })
    </script>
    <script>
        $(document).ready(function(){
           $('.select-companies').select2();
        })
    </script>

@endpush


