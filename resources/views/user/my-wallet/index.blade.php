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
  {{ __('master.show_my_wallet') }}
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
            <div class="text-left container-button-create-account">
                <button class="btn btn-success create-new-account" data-toggle="modal" data-target="#modal-lg">
                    <i class="fas fa-plus"></i>
                    {{ __('master.charge_my_wallet') }}
                </button>
            </div>
            <table class="table table-striped">
                <thead class="">
                    <tr style="background-color: white;">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('master.money_value') }}</th>
                        <th scope="col">{{ __('master.payment_method') }}</th>
                        <th scope="col">{{ __('master.order_status') }}</th>
                        <th scope="col">{{ __('master.created_at') }}</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recharge_orders as $order)
                        <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ amount_currency($order->value) }}</td>
                            <td>
                                {{ $order->payment_method ? $order->payment_method->ar_payment_name : '-'  }}
                                <img class="image-payment-method" src="{{ $order->payment_method->thumbnail }}" />
                            </td>
                            <td>{!! $order->status_order !!}</td>
                            <td>{{  $order->created_at }}</td>
                            <td>
                                @if($order->status == 0)
                                    <form method="POST" action="{{ url('my-wallet/'.$order->id) }}" onsubmit="FormSubmitDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">الغاء</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="modal fade" id="modal-lg" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="app">
                <div class="modal-header">
                    <h4 class="modal-title">شحن محفظتى</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('my-wallet.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <p class="label-model">اختار وسيلة الدفع</p>
                                    <select name='payment_id' class="select-companies" required>
                                        <option>اختار وسيلة الدفع </option>
                                        @forelse($payments as $payment)
                                            <option value="{{ $payment->ID }}"> {{ $payment->ar_payment_name }} </option>
                                        @empty
                                            <option> لا يوجد اى وسائل دفع متاحه</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <p class="label-model">قيمة المبلغ المشحون  ( $ )</p>
                                    <input name="value" type="number" step="10.00"  class="form-control"  required>
                                </div>

                                <div class="input-group mb-3">
                                    <p class="label-model">رقم عملية التحويل</p>
                                    <input name="transaction_no" type="text" class="form-control">
                                </div>
                                <div class="input-group mb-3">
                                    <p class="label-model">كتابة ملاحظة ان وجدت </p>
                                    <textarea name="notice" rows="3"  class="form-control"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <p class="label-model">رقم عملية التحويل</p>
                                    <input name="image" type="file" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group container-button">
                                    <button type="submit" class="btn btn-success">
                                        انشاء طلب شحن
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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


