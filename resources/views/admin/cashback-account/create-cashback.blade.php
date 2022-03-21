@extends('master')

@section('css')
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/Adminlte-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">

@stop

@section('plugins.Select2', true)

@section('content_header')
   عرض  الحسابات الكاش باك
@stop


@section('content')
    <div class="row">
        <div class="container mt-5">
            @if(!empty(session('message')))
                <div class="alert alert-success">
                    <ul>
                        <li>{{  session('message') }}</li>
                    </ul>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="card card-default">
                    <form method="POST" action="{{ route('cashback-accounts.store') }}">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title"> اضافة كاش باك باسم الشركة</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label-model">اسم شركة التداول</label>
                                        <select name="company_id" class="select-companies">
                                            @forelse($accounts as $account)
                                                <option value="{{ $account->forex_company->id ?? '' }}">{{ $account->forex_company->name_ar ?? '' }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>قيمة الكاش باك</label>
                                        <input name="value" class="form-control select2 companies" type="number" step="any" min="0" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>الشهر المحدد للكاش باك</label>
                                        <input name="month" class="form-control select2 companies" type="month" step="any" min="0" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">اضافة الكاش باك</button>
                                    </div>
                                </div>
                            
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </form>
                </div>
            {!! $dataTable->table() !!}
        </div>
    </div>
    

    <div class="modal fade" id="modal-lg" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="app">

            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('js')


    {{-- rtl bootstrap  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script src="{{ asset('js/admin_custom.js') }}" ></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script> console.log('Hi!'); </script>
    {!! $dataTable->scripts() !!}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery(document).on('click','.updateCashback',function(e){
            var Cashback_ID =  jQuery(this).attr('data-id');
            var url_create  =  "{{ url('cashback-accounts/:id:/edit') }}";
            $.ajax({
                type:'GET',
                url:url_create.replace(':id:',Cashback_ID),
                success:function(data){
                    console.log(data);
                    jQuery('.modal-content').html(data.html)
                    $("#modal-lg").modal('show');
                }
            });
        });

        jQuery(document).on('click','.addCashback',function(e){
            var Cashback_ID =  jQuery(this).attr('data-id');
            $.ajax({
                type:'GET',
                url:"{{ route('cashback-accounts.create') }}",
                data:{
                    ID:Cashback_ID
                },
                success:function(data){
                    console.log(data);
                    jQuery('.modal-content').html(data.html)
                    $("#modal-lg").modal('show');
                }
            });
        });

        $(document).ready(function(){
           $('.select-companies').select2();
        })
    </script>

@stop


