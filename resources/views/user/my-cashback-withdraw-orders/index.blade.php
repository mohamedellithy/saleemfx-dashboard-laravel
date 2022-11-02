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
  {{ __('master.my_cashback_withdraw_orders') }}}
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
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-warning"><i class="fas fa-wallet"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('master.totale_balance') }}</span>
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
                            <span class="info-box-text">{{ __('master.totale_cashback') }}</span>
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
                            <span class="info-box-text"> {{ __('master.total_withdraw') }} </span>
                            <span class="info-box-number">{{ amount_currency(auth()->user()->total_withdraws()) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-warning"><i class="fas fa-fist-raised"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> {{ __('master.totale_withdraw_orders_pending') }} </span>
                            <span class="info-box-number">{{ amount_currency(auth()->user()->withdraw_cashbacks_pendings_total()) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-warning"><i class="fas fa-check-circle"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> {{ __('master.totale_expire_cashback') }} </span>
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
                            <span class="info-box-text"> {{ __('master.totale_available_cashback') }}</span>
                            <span class="info-box-number">{{ amount_currency(auth()->user()->total_cashback_can_withdraw() - auth()->user()->total_expire_cashbacks()) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
            <div class="text-left container-button-create-account">
                <button class="btn btn-success create-new-account" data-toggle="modal" data-target="#modal-lg">
                    <i class="fas fa-plus"></i>
                      {{ __('master.withdrawal-requests-marketing-profits') }}
                </button>
            </div>
            <h5 class="card-title m-0" style="padding: 11px 1px;">
                {{ __('master.withdrawal-requests-marketing-profits') }}
            </h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> {{ __('master.money_needed') }} </th>
                        <th> {{ __('master.wallet') }}  </th>
                        <th> {{ __('master.wallet_account_number') }} </th>
                        <th> {{ __('master.created_at') }} </th>
                        <th> {{ __('master.order_status') }}  </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @forelse(auth()->user()->withdraw_form_cashbacks()->latest()->get() as $withdraw_cashback_order)
                        <tr>
                            <td>{{ amount_currency($withdraw_cashback_order->withdraw_value) }}</td>
                            <td>{{ $withdraw_cashback_order->wallet }}</td>
                            <td>{{ $withdraw_cashback_order->wallet_account }}</td>
                            <td>{{ $withdraw_cashback_order->created_at }}</td>
                            <td>{!! $withdraw_cashback_order->status_order  !!}</td>
                            <td>
                                @if($withdraw_cashback_order->status == 0)
                                    <form method="POST"  action="{{ route('my-withdraw-orders.destroy',$withdraw_cashback_order->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" >{{ __('master.cancel_order') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"> {{ __('master.not_found_cashback') }}</td>
                        </tr>
                    @endforelse

                    @forelse(auth()->user()->withdraw_for_services()->latest()->get() as $withdraw_services_order)
                        <tr>
                            <td>{{ amount_currency($withdraw_services_order->withdraw_value) }}</td>
                            <td colspan="2"> {{ __('master.subscrib_services') }} ( {{ $withdraw_services_order->Withdrawable->services->post_title ?? '' }} )</td>
                            <td>{{ $withdraw_services_order->created_at }}</td>
                            <td>{!! $withdraw_services_order->status_order  !!}</td>

                        </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
    <x-withdraw-cashback :payments="$payments"></x-withdraw-cashback>

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


