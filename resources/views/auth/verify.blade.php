@extends('auth.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
           <div class="title title-forex-login">
                <h3> مع سليم انت فى السليم </h3>
            </div> 
            <div class="card ">
                <div class="card-header card-header-login">قم بتأكيد بريدك الاكترونى </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-info" role="alert">
{{ __('
تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.') }}
                        </div>
                    @endif

                    <div class="alert alert-success" role="alert"> {{ __('قبل المتابعة ، يرجى التحقق من بريدك الإلكتروني للحصول على رابط التحقق.') }} 
                    {{ __('إذا لم تستلم البريد الإلكتروني') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('انقر هنا لطلب آخر') }}</button>.
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
