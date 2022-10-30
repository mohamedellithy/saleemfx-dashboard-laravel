@extends('master')

@section('css')
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vanilla-datetimerange-picker.css') }}" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <link rel="stylesheet" href="{{ asset('css/Adminlte-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">

    <style>
        .nice-select.status {
           display: block !important;
           width: 100%;
        }
    </style>

@stop

@section('plugins.Select2', true)

@section('plugins.niceSelect',true)

@section('content_header')
   عرض الكاش باك
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
            <div class="show-buttons-filter">
                <div class="form-group data-search">
                     <label> البحث بالتاريخ </label>
                     <input name="DateBetween" class="form-control vipOrders status" type="text" placeholder="البحث بالتاريخ" id="datetimerange-input1" />
                </div>
                <div class="form-group data-search">
                    <label> البحث بالتاريخ </label>
                    <select name="services" class="services status">
                        <option value="">كل الكاشات</option>
                        <option value="">الكاش باك المنتهي</option>
                        <option value="">الكاش باك الغير منتهى</option>
                    </select>
                </div>
                <div class="form-group data-search">
                    <label></label>
                    <button type="button" class="btn btn-danger btn-sm btn_delete_selected">حذف</button>
                </div>
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
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="{{ asset('js/vanilla-datetimerange-picker.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script src="{{ asset('js/admin_custom.js') }}" ></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script> console.log('Hi!'); </script>
    {!! $dataTable->scripts() !!}

    <script>
        $(document).ready(function() {
            $('select.status').niceSelect();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let url_dataTable = {};
        new DateRangePicker('datetimerange-input1', {
            placeholder:'أبحث بالتاريخ',
            locale: {
                direction: 'rtl',
                format: moment.localeData().longDateFormat('L'),
                separator: '-',
                applyLabel: 'بحث',
                cancelLabel: 'الغاء',
                weekLabel: 'W',
                customRangeLabel: 'Custom Range',
                daysOfWeek: moment.weekdaysMin(),
                monthNames: moment.monthsShort(),
                firstDay: moment.localeData().firstDayOfWeek()
            },
            // options here
        }, function (start, end) {
            // callback
            url_dataTable.from = start.format("YYYY-MM-DD");
            url_dataTable.to   = end.format("YYYY-MM-DD");
            http_query_build(url_dataTable);
            console.log(start.format("DD-MM-YYYY") + "," + end.format("DD-MM-YYYY"));
        });

        function http_query_build(url_dataTable){
            let params;
            params = new URLSearchParams(url_dataTable);
            const str = params.toString();
            console.log("{{ route('cashback-accounts.index') }}?"+str);
            $('#cashbackdatatables-table').DataTable().ajax.url("{{ route('cashback-accounts.index') }}?"+str).load();
        }

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
    </script>

    <script>
    $('table').on('submit','form.form-delete',function(e){
        e.preventDefault();
        $.confirm({
            title: 'هل تريد حذف العنصر ؟',
            content: 'قم بالتأكد من العنصر قبل اجراء عملية الحذف',
            type: 'red',
            buttons: {
                ok: {
                    text: "موافق ",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function(){
                        e.target.submit();
                    }
                },
                cancel: {
                    text: "الغاء ",
                    btnClass: 'btn-danger',
                    keys: ['esc'],
                    action :function(){

                    }
                }
            }
        });
    });
    </script>

@stop


