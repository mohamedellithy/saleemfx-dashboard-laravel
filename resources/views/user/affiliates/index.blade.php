@extends('master')

@section('css')
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/Adminlte-rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    <style type="text/css">
    .table td, .table th{
        border-top:0px solid #eee;
    }
    .card{
        border-radius: 0px;
    }
    </style>
@stop

@section('plugins.Sweetalert2', true)

@section('plugins.Select2', true)

@section('content_header')
  {{ __('master.affiliate-marketing') }}
@stop


@section('content')
    <div class="row">
        <div class="container mt-5">
            <div class="col-md-12 col-xs-12">
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
            </div>
            @if(!auth()->user()->is_affiliater())
                <div class="container-image-chashback col-md-6 col-xs-12">
                    <img src="{{ asset('images/affiliate-blogs.png') }}"/>
                    <h2 class="title-image-chashback"> {{ __('master.affiliate-marketing') }}</h2>

                    <form method="post" action="{{ url('affiliates/store') }}">
                        @csrf()
                        <button class="btn btn-success create-new-account" data-toggle="modal" data-target="#modal-lg">
                            <i class="fas fa-plus"></i>
                            {{ __('master.create_new_account_affiliate') }}
                        </button>
                    </form>

                </div>
            @else

            <div class="col-md-12 col-xs-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">{{ __('master.affiliate-marketing') }}</h5>
                    </div>
                    <div class="card-body">
                    <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td> {{ __('master.Link-to-your-affiliate-account') }} </td>
                                        <td>
                                            <input id="affiliateUrl" class="form-control" type="url" value="{{ url('register?reference_id='.auth()->user()->affiliates->code_affiliate) }}" readonly/>
                                        </td>
                                        <td class="clone-url-affiliate">
                                            <i onclick="copyData(affiliateUrl)" class="far fa-clone"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br/>
                            <form method="post" action="{{ url('affiliatees/send-invitation') }}">
                                @csrf
                                <table class="send-invitation">
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <p class="text-center heading-invitation"> {{ __('master.invite_your_friends')  }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <input class="form-control" type="email" name="invitee_email" value="" placeholder="{{ __('master.Write-your-email-here') }}" required/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="button-invite-send">
                                                <button type="submit" class="btn btn-success"> {{ __('master.send-invitation')  }}</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@stop


@push('js')
    {{-- rtl bootstrap  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    @if(app()->getLocale() == 'ar')
        <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>
    @endif
    <script>
        $(document).ready(function(){
           $('.select-companies').select2();
        })
    </script>
    <script>
        function copyData(containerid) {
            jQuery('.fa-clone').css({'color':'orange'});
            var range = document.createRange();
            range.selectNode(containerid); //changed here
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
        }
    </script>

@endpush
