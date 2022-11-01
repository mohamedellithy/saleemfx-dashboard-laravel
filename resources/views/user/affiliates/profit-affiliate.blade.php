@extends('master')

@section('css')
    @if(app()->getLocale() == 'ar')
         <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    @endif
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('css/Adminlte-rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    <style>
        .select2-container {
            width: 25% !important;
            float: left;
            margin: 0px 10px;
        }
        table.dataTable{
            width:100% !important;
        }
    </style>
@stop


@section('content_header')
  العملاء المدعويين
@stop

@section('plugins.niceSelect',true)

@section('content')
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="fas fa-money-bill"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">اجمالى أرباح التسويق</span>
                        <span class="info-box-number">{{ auth()->user()->affiliates ? amount_currency(auth()->user()->affiliates->value_comissions() ) : 0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            @if( auth()->user()->affiliates && (auth()->user()->affiliates->employee == 1))
                <div class="col-md-3 col-sm-6">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-warning"><i class="fas fa-money-bill"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">اجمالى أرباح التسويق</span>
                            <span class="info-box-number">{{ auth()->user()->affiliates ? amount_currency(auth()->user()->affiliates->value_salaries() ) : 0 }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            @endif

            <div class="col-md-3 col-sm-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="fas fa-check-circle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> اجمالى المسحوب</span>
                        <span class="info-box-number">{{ amount_currency(auth()->user()->total_cashbacks_withdraws()) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-warning"><i class="fas fa-fist-raised"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> طلبات السحب المعلقة</span>
                        <span class="info-box-number">{{ amount_currency(auth()->user()->withdraw_cashbacks_pendings_total()) }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="text-left container-button-create-account">
            <button class="btn btn-success create-new-account" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-plus"></i>
                    طلبات سحب الرباح
            </button>
        </div>
        <div class="container mt-5">

            @if(!empty(session('message')))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{  session('message') }}</li>
                        </ul>
                    </div>
            @endif
            {!! $dataTable->table() !!}
        </div>
    </div>

    <div class="modal fade" id="modal-lg" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">طلب سحب أرباح التسويق بالعمولة</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="badge badge-info" style="font-size:100%"> أرباح التسويق بالعمولة    : {{ auth()->user()->affiliates ? amount_currency(auth()->user()->affiliates->value_profits() ) : 0 }}</p>
                    @if( auth()->user()->affiliates && auth()->user()->affiliates->value_profits() > 0)
                        <form method="post" action="{{ url('affiliatees/order-withdraw') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <p class="label-model">قيمة المبلغ المطلوب للسحب</p>
                                        <input name="value" type="number" class="form-control" max="{{ auth()->user()->affiliates->value_profits() }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group container-button">
                                        <button type="submit" class="btn btn-success">
                                            ارسال الطلب
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <p class="alert alert-danger">   لا يمكنك اجراء عمليات سحب من الرصيد رصيدك الحالى غير كافى لاتمام عملية السحب</p>
                    @endif
                </div>

            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('js')


    {{-- rtl bootstrap  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    @if(app()->getLocale() == 'ar')
        <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>
    @endif
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script src="{{ asset('js/admin_custom.js') }}" ></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script> console.log('Hi!'); </script>

    {!! $dataTable->scripts() !!}
@stop
