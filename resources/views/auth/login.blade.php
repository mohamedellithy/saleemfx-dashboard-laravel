@extends('auth.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="title title-forex-login">
                <h3> مع سليم انت فى السليم </h3>
            </div>
            <div class="card">
                <div class="card-header card-header-login">{{ __('تسجيل الدخول') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" placeholder="البريد الالكترونى أو اسم المستخدم " type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password"  placeholder="كلمة المرور" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning login-button">
                                    {{ __('تسجيل الدخول') }}
                                </button>
                                <br/>
                                <a class="btn btn-link btn-link-rememebr-password" href="{{ route('register').'?reference_id='.session('refrence_affiliate_id') }}">
                                    {{ __('لا تمتلك حساب ؟ قم بالتسجيل') }}
                                </a>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-link-rememebr-password" href="{{ route('password.request') }}">
                                        {{ __('هل نسيت كلمة المرور ؟') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
