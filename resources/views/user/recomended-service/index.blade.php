@extends('master')

@section('css')
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/Adminlte-rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">

@stop

@section('plugins.Sweetalert2', true)

@section('plugins.Select2', true)

@section('content_header')
  {{ __('master.recommended-services') }}
@stop


@section('content')
    @if($service->not_allowed_to_user)
        <div class="row">
            <div class="container-image-chashback col-md-6 col-xs-12">
                <img src="{{ asset('images/cashback.jpg') }}"/>
                <h2 class="title-image-chashback"> {{ __('master.join-recommendation-services') }}</h2>

                @if($service->user_not_have_order)

                    <button type="button" type-form="create" class="btn btn-warning activateServices" order-id="" SERVICES-ID="{{ $service->ID }}"> {{ __('master.subscription-to-the-service') }} </button>

                @elseif($service->user_have_order_expire_at)

                    <a href="{{ url('my-services') }}" type="button" type-form="create" class="btn btn-warning"> {{ __('master.renew-your-subscription-to-the-service') }}</a>

                @elseif($service->user_have_order_and_allow)

                    <p class="alert alert-info">
                        {{ __('master.accept_request_form_admin') }}
                    </p>

                @endif
            </div>
            <x-create-account :companies="$companies"></x-create-account>
        </div>
    @else
        <div class="row">
            <div class="container mt-5">

                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body recomended-services-button">
                        <img src="{{ asset('images/26196843.jpg') }}" class="img-responsive" />
                         <a href="{{ Options()->setting['telegram_channel_link'] ?? '' }}" target="_blank" class="btn btn-success"> {{ __('master.join-recommendation-services') }} </a>
                    </div>
                </div>

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
        });

        jQuery(document).on('click','.activateServices',function(e){
            var SERVICES_ID =  jQuery(this).attr('SERVICES-ID');
            var type_form   =  jQuery(this).attr('type-form');
            var orderId     =  jQuery(this).attr('order-id');
            console.log( type_form);
            $.ajax({
                type:'GET',
                url:"{{ route('my-services.create') }}",
                data:{
                    ID:SERVICES_ID,
                    type_form:type_form,
                    order_id:orderId
                },
                success:function(data){
                    jQuery('.modal-content').html(data.html)
                    $("#modal-lg").modal('show');
                }
            });
        });


    </script>

@endpush


