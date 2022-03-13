@extends('master')

@section('content_header')
   تعديل تصنيفات التحليلات
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
            @if(!empty(session('message')))
                <div class="alert alert-success">
                    <ul>
                        <li>{{  session('message') }}</li>
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('analytics-categories.update',$analytics_category->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">تعديل شركة التداول</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">اسم الشركة باللغة العربية</span>
                                    </div>
                                    <input name="name_ar" value="{{ $analytics_category->name_ar ?? '' }}" type="text" class="form-control" placeholder="اسم الشركة باللغة العربية">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">اسم الشركة باللغة الانجليزية</span>
                                    </div>
                                    <input name="name_en" value="{{ $analytics_category->name_en ?? '' }}" type="text" class="form-control" placeholder="اسم الشركة باللغة الانجليزية">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="input-group container-button">
                                    <button type="submit" class="btn btn-success">
                                        حفظ التعديلات
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
