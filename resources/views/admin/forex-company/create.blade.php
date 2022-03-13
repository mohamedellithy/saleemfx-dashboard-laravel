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
            <form method="post" action="{{ route('forex-companies.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">اضافة شركة التداول</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">اسم الشركة باللغة العربية</span>
                                    </div>
                                    <input name="name_ar" type="text" class="form-control" placeholder="اسم الشركة باللغة العربية" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">اسم الشركة باللغة الانجليزية</span>
                                    </div>
                                    <input name="name_en" type="text" class="form-control" placeholder="اسم الشركة باللغة الانجليزية" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">رابط الشركة <i class="fas fa-link"></i></span>
                                    </div>
                                    <input name="link_company" type="url" class="form-control" placeholder="رابط الشركة" >
                                </div>
                            </div>
                            <div class="col-md-4 section-image">
                                <upload-image></upload-image>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group container-button">
                                    <button type="submit" class="btn btn-success">
                                        اضافة الشركة
                                    </button>
                                </div>
                            </div>
                        <div>
                        <!-- /input-group -->
                    </div>
                <!-- /.card-body -->
                </div>
            </form>
        </div>
    </div>
@stop
