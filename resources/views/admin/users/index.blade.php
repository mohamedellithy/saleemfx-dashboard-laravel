@extends('master')

@section('css')
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vanilla-datetimerange-picker.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/Adminlte-rtl.css') }}">
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
        .table td, .table th {
            padding: 1rem 0em 0.8em 0.8em;
        }
        .data-search.search-users{
            float:none !important;
        }
    </style>
@stop


@section('content_header')
  عرض المستخدمين
@stop

@section('plugins.niceSelect',true)

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

            <div class="show-buttons-filter">
                <div class="form-group data-search search-users">
                     <label> البحث بالتاريخ </label>
                     <input name="DateBetween" class="form-control vipOrders status" type="text" placeholder="البحث بالتاريخ" id="datetimerange-input1" />
                </div>
                <select name="forex-comapny" class="forexComapny status">
                    <option value="">شركات التداول</option>
                    @forelse($forexCompanies as $forex)
                        <option value="{{ $forex->id }}">{{ $forex->name_ar }}</option>
                    @empty
                    @endforelse
                </select>

                <select name="services" class="services status">
                    <option value="">الخدمات</option>
                    @forelse($services as $service)
                        <option value="{{ $service->ID }}">{{ $service->post_title }}</option>
                    @empty
                    @endforelse
                </select>

                <select name="vipOrders" class="vipOrders status">
                    <option value="">طلبات ال vip</option>
                    <option value="1">المشتركين فى الخدمة</option>
                    <option value="2">الغير مشتركين</option>
                </select>

                <select name="cashbacks" class="cashbacks status">
                    <option value="">الكاش باك</option>
                    <option value="1">لديهم كاش باك</option>
                    <option value="2">ليس لديهم</option>
                </select>
            </div>
            {!! $dataTable->table() !!}
        </div>
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
    <script src="{{ asset('js/admin_custom.js') }}" ></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script> console.log('Hi!'); </script>

    {!! $dataTable->scripts() !!}
    <script>
        function FormSubmitDelete(e) {
            e.preventDefault();
            var confirm = window.confirm('هل انت متأكد من حذف هذا العنصر ؟');
            if (confirm == true) {
                e.target.submit();
            }
        }
    </script>
    <script>
        $(document).ready(function(){
           $('.select-columns').select2();
        });

        $(document).ready(function() {
            var table = $('#usersdatatable-table').DataTable();
            table.column( 7 ).visible(false);
        });

        $(document).ready(function() {
            $('select.status').niceSelect();
        });
    </script>

    <script type="text/javascript">
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

        jQuery(document).on('change','.status.forexComapny',function() {
            let forexComapny = jQuery(this).val();
            url_dataTable.company = forexComapny;
            http_query_build(url_dataTable);
        });

        jQuery(document).on('change','.status.services',function() {
            let services = jQuery(this).val();
            url_dataTable.services = services;
            http_query_build(url_dataTable);
        });

        jQuery(document).on('change','.status.vipOrders',function() {
            let vipOrders = jQuery(this).val();
            url_dataTable.vipOrders = vipOrders;
            http_query_build(url_dataTable);
        });

        jQuery(document).on('change','.status.cashbacks',function() {
            let cashbacks = jQuery(this).val();
            url_dataTable.cashbacks = cashbacks;
            http_query_build(url_dataTable);
        });

        function http_query_build(url_dataTable){
            let params;
            params = new URLSearchParams(url_dataTable);
            const str = params.toString();
            console.log("{{ url()->current() }}?"+str);
            $('#usersdatatable-table').DataTable().ajax.url("{{ url()->current() }}?"+str).load();
        }
    </script>
    
@stop
