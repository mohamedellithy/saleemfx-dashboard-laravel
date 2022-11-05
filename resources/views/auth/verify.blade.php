@extends('auth.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
           <div class="title title-forex-login">
                <h3> {{ __('master.with-Seleem-you-are-in-the-right') }} </h3>
            </div> 
            <div class="card ">
                <div class="card-header card-header-login"> {{ __('master.confirm-your-email') }} </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-info" role="alert">
                            {{ __('master.new-verification-link-has-been-sent-to-your-email-address') }}
                        </div>
                    @endif

                    <div class="alert alert-success" role="alert"> {{ __('master.before-proceeding-please-check-your-email-for-verification-link') }} 
                    {{ __('master.If-you-did-not-receive-the-email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('master.click-here-to-order-another') }}</button>.
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
