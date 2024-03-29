@extends('auth.master')
@push('css')
    @if(request()->has('account'))
        <style>
        .card-header-login{
           font-size: 25px !important;
        }
        </style>
    @endif
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <br/>
            <div class="col-md-6 col-md-offset-3 col-xs-12 title title-forex-login">
                <h3 class=""> {{ __('master.with-Seleem-you-are-in-the-right') }} </h3>
                
            </div>
            @if(request()->has('account'))
                <div class="col-md-6 col-md-offset-3 col-xs-12 title title-forex-login" style="margin-top:5%">
                     <p style="font-size: 20px;line-height: 2em;margin: auto;color: white;font-weight: bolder;margin-bottom: 14%;"> كن شريكا لنا و أحصل على عمولتك من خلال الاشتراك فى منصتنا كمسوق بالعمولة</p>
                </div>
              
            @endif
        </div>
        <div class="col-md-4 col-xs-12">
            <br/>
            <div class="card">
                <div class="card-header card-header-login">{{ __('master.register') }}
                @if(request()->has('account'))
                    {{ __('master.In-the-affiliate-marketing-program') }}
                @endif
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-6">
                                <input id="firstname" placeholder="{{ __('master.first-name') }}" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input id="lastname" placeholder="{{ __('master.last-name') }}" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="name" placeholder="{{ __('master.user-name') }}" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="phone" placeholder="{{ __('master.phone-number') }}" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" placeholder="{{ __('master.email') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" placeholder="{{ __('master.password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password-confirm" placeholder="{{ __('master.confirm_password') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        @if(request()->has('account'))
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" value="{{ request()->query('account') ?? '' }}" class="form-control" name="account" hidden>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning login-button">
                                    {{ __('master.create_new_account') }}
                                </button>
                            </div>
                            @if(!session('refrence_affiliate_id'))
                                <a class="btn btn-link btn-link-rememebr-password" href="{{ route('login') }}">
                                    {{ __('master.do-you-have-an-account-sign-in') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
