@extends('auth.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="title title-forex-login">
                <h3> {{ __('master.with-Seleem-you-are-in-the-right') }} </h3>
            </div>
            <div class="card">
                <div class="card-header card-header-login">{{ __('master.confirm_password') }}</div>
               
                <div class="card-body">
                    <div class="alert alert-danger">{{ __('master.please-confirm-the-password') }}</div>
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                           <div class="col-md-12">
                                <input id="password" placeholder="{{ __('master.password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                                    {{ __('master.confirm_password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-link-rememebr-password" href="{{ route('password.request') }}">
                                        {{ __('master.Forgot-your-password') }}
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
