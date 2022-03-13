@extends('master')

@section('content_header')
   اضافة شركة التداول
@stop

@section('content')
    <div class="row" id="app">
        <div class="col-lg-12">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(!empty($message))
                <div class="alert alert-success">
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('cashback/import-cashback') }}" enctype="multipart/form-data">
                @csrf
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">استيراد ملف كاش باك</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4 section-image" style="margin:auto">
                                <input type="file" name="xlx_file" required/>
                            </div><br/>
                            <div class="col-md-12">
                                <div class="input-group container-button">
                                    <button type="submit" class="btn btn-success" style="margin:auto">
                                        ابدأ الاستيراد
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /input-group -->
                    </div>
                <!-- /.card-body -->
                </div>
            </form>
        </div>
    </div>
@stop
