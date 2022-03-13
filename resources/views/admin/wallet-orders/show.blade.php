@extends('master')

@section('content_header')
   تفاصيل الطلب
@stop

@section('plugins.SimpleLightBox',true)
@push('css')
   <style>
        .cashback_tables{
            height: 300px;
            overflow-y: auto;
        }
        .payment_method_image
        {
            width: 20%;
        }
        .gallery img
        {
            width: 60%;
            border: 4px solid #ffc107;
        }
   </style>
@endpush

@section('content')
        @if(!empty(session('message')))
            <div class="alert alert-success">
                <ul>
                    <li>{{  session('message') }}</li>
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">عرض بيانات المستخدم</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">

                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>قيمة المبلغ</td>
                                    <td>
                                        {{ amount_currency($wallet_order->value) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>1.</td>
                                    <td>اسم المستخدم</td>
                                    <td>
                                        <a href="{{ url('users/'.$wallet_order->user->id) }}">{{ $wallet_order->user->username }}</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>1.</td>
                                    <td>وسيلة الدفع</td>
                                    <td>
                                        {{ $wallet_order->payment_method ? $wallet_order->payment_method->ar_payment_name : '-'  }}
                                        <img class="img-responsive payment_method_image" src="{{ $wallet_order->payment_method->thumbnail }}"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>1.</td>
                                    <td>حالة الطلب</td>
                                    <td>
                                        {!! $wallet_order->status_order !!}
                                    </td>
                                </tr>

                                <tr>
                                    <td>1.</td>
                                    <td>تاريخ الانشاء</td>
                                    <td>
                                        {{ $wallet_order->created_at }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>1.</td>
                                    <td>رقم التحويل</td>
                                    <td>
                                        {{ $wallet_order->transaction_no }}
                                    </td>
                                </tr>

                                <tr>
                                    <td>1.</td>
                                    <td>ملاحظات المستخدم</td>
                                    <td>
                                        {{ $wallet_order->notice }}
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                         <!-- /.card-body -->
                    </div>
                </div><!-- /.card -->
            </div>
            <div class="col-lg-6">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">صورة فاتورة الدفع</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body cashback_tables p-0">

                            <div class="gallery">
                                <a href="{{ asset('storage/'.$wallet_order->images->first()->image_url) }}"><img src="{{ asset('storage/'.$wallet_order->images->first()->image_url) }}" alt="" title="{{ 'طلب رقم #'.$wallet_order->id.' ( '.($wallet_order->payment_method ? $wallet_order->payment_method->ar_payment_name : '-').' ) ' }}"/></a>
                                <div class="clear"></div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">حالة الطلب</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body p-0">
                            <div class="btn-group">
                                <button type="button" class="btn {{ $wallet_order->status == 0 ? 'btn-danger' : 'btn-success' }}">تغير الحالة</button>
                                <button type="button" class="btn {{ $wallet_order->status == 0 ? 'btn-danger' : 'btn-success' }} dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                     <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu" style="">
                                    <a class="dropdown-item {{ $wallet_order->status == 0 ? 'hidden-item-status':'' }}"  href="{{ url('change-wallet-recharge-orders/'.$wallet_order->id.'/0') }}" >قيد التنفيذ </a>
                                    <a class="dropdown-item {{ $wallet_order->status == 1 ? 'hidden-item-status':'' }}"  href="{{ url('change-wallet-recharge-orders/'.$wallet_order->id.'/1') }}" > قبول الطلب </a>
                                    <a class="dropdown-item {{ $wallet_order->status != 0 ? 'hidden-item-status':'' }}"  href="{{ url('change-wallet-recharge-orders/'.$wallet_order->id.'/2') }}" > رفض الطلب </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@push('js')
  <script>
        (function() {
            var $gallery = new SimpleLightbox('.gallery a', {});
        })();
  </script>
@endpush
