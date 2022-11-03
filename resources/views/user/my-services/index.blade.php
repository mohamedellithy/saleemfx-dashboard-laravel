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
  {{ __('master.my-services') }}
@stop


@section('content')
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
            <h5 class="heading-ad-services"> {{ __('master.my-services-subscribe') }}</h5>

            <!-- <div class="services-vip">
                if(auth()->user()->vip_order->first())
                    if(auth()->user()->vip_order->first()->status == 0 )
                        <a class="btn btn-warning" href="#"> طلب الاستراك فى خدمة vip قيد التنفيذ</a>
                    elseif(auth()->user()->vip_order->first()->status == 1 )
                        <a class="btn btn-success" href="#"> تم الاشتراك فى خدمة vip</a>
                    else
                    <a class="btn btn-primary"  href="{{ route('vip-services.create') }}"> الاشتراك فى خدمة ال vip</a>
                    endif
                else
                    <a class="btn btn-primary"  href="{{ route('vip-services.create') }}"> الاشتراك فى خدمة ال vip</a>
                endif
            </div> -->

            <div class="row" >
                    @forelse(auth()->user()->allow_services_order() as $order)
                            <div class="col-md-4 ad-services my-services ">
                                <div class="content-ad-services" style="background-image:url('{{ $order->services->thumbnail ?? asset('images/social.png') }}')">
                                    <h6> {{ $order->services->post_title }} </h6>

                                    @if($order->acount)
                                        <div class="footer-ad-services" >
                                             <p class="">{{ $order->acount->forex_company->name_ar ?? '' }}</p>
                                        </div>
                                    @endif

                                    <div class="footer-ad-services" >
                                        @if(($order->expire_at != null) && ($order->status != 0))
                                            <button type="button" type-form="edit" order-id="{{ $order->id }}" SERVICES-ID="{{ $order->service_id }}" class="btn btn-success activateServices"> {{ __('master.renew-your-subscription-to-the-service') }}</button>
                                        @elseif(($order->expire_at != null) && ($order->status == 0))
                                            <button type="button" class="btn btn-info"> {{ __('master.waiting-for-request-review') }} </button>
                                        @endif
                                    </div>

                                    @if($order->expire_at != null)
                                        <p class="subscription-date"> {{ __('master.subscription-expiration-date') }} {{ $order->expire_at }} </p>
                                    @endif
                                </div>
                            </div>

                    @empty
                        <p class="no-adds text-center" style="margin-top:10px">  {{ __('master.no-services-available') }}  </p>
                    @endforelse

            </div>


            <br/>
            <h5 class="heading-ad-services">{{ __('master.other-services') }}</h5>
            <div class="row" >
                @forelse($services as $service)
                    <div class="col-md-4 ad-services my-services ">
                        <div class="content-ad-services" style="background-image:url('{{ $service->thumbnail ?? asset('images/social.png') }}')">
                            <h6> {{ $service->post_title }} </h6>
                            <br/><br/><br/>
                            <div class="footer-ad-services">
                                <button type="button" type-form="create" class="btn btn-warning activateServices" order-id="" SERVICES-ID="{{ $service->ID }}">{{ __('master.activate') }} </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="no-adds text-center"> {{ __('master.no-services-available') }} </p>
                @endforelse
            </div>

        </div>
    </div>
    <x-subscription-services></x-subscription-services>
@stop

@push('js')


    {{-- rtl bootstrap  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>

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


