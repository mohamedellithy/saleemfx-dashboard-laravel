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
        .form-statu{
            display: inline-block;
            float: left;
        }
        .nice-select{
            float:right !important;
        }
        #datetimerange-input1{
            width: auto;
            float: left;
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
                <form class="form-status" method="post" action="{{ url('update-accounts-bulk') }}">
                    @csrf
                    <select name="status" class="vipOrders status">
                        <option value="">حالة الطلب</option>
                        <option value="0">قيد التنفيذ</option>
                        <option value="1">موافقة </option>
                        <option value="2">رفض </option>
                    </select>

                    <input id="inputAccounts" type="hidden" name="select-accounts" />

                    <button name="cashbacks" class="cashbacks status btn btn- btn-success">تحديث الحالة</button>
                </form>
            </div>

            <div class="show-buttons-filter">
                <input name="datebetween" class="form-control vipOrders status" type="text" placeholder="البحث بالتاريخ" id="datetimerange-input1" />
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
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="{{ asset('js/vanilla-datetimerange-picker.js') }}"></script>

    <script src="{{ asset('js/admin_custom.js') }}" ></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>


    <script> console.log('Hi!'); </script>

    {!! $dataTable->scripts() !!}
    <script>
        let url_dataTable = {};
        new DateRangePicker('datetimerange-input1', {
            // options here
        }, function (start, end) {
            // callback
            let vipOrders = jQuery('#datetimerange-input1').val();
            url_dataTable.vipOrders = vipOrders;
            http_query_build(url_dataTable);
        })
        $(document).ready(function() {
            $('select.status').niceSelect();
        });

        $('.form-status').submit(function(event){
            let accounts_id = [];
            document.querySelectorAll('input.select-accounts:checked').forEach((item) => {
                accounts_id.push(item.getAttribute('data-value'));
            });

            document.getElementById('inputAccounts').value = Array.from(accounts_id);
            if(accounts_id.length == 0){
                return false;
            }

            var confirm = window.confirm('هل انت متأكد من تحديث الحسابات المحددة ؟');
            if (confirm == true) {
                return true;
            }

            return false;
        });

        function FormSubmitDelete(e) {
            e.preventDefault();
            var confirm = window.confirm('هل انت متأكد من حذف هذا العنصر ؟');
            if (confirm == true) {
                e.target.submit();
            }
        }

        function http_query_build(url_dataTable){
            let params;
            params = new URLSearchParams(url_dataTable);
            const str = params.toString();
            console.log("{{ url()->current() }}?"+str);
            $('#usersdatatable-table').DataTable().ajax.url("{{ url()->current() }}?"+str).load();
        }
    </script>
@stop


