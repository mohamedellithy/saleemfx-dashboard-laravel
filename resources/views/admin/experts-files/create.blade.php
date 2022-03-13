@extends('master')


@section('plugins.bootstrapSwitch',true)

@section('content_header')
   اضافة ملفات الاكسبرتات
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
            <form method="POST" action="{{ route('experts-files.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card card-info" id="app">
                    <div class="card-header">
                        <h3 class="card-title">اضافة ملفات الاكسبرتات</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">اسم ملف الاكسبرت</span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="اسم ملف الاكسبرت">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">وصف ملف الاكسبرت</span>
                                    </div>
                                    <textarea name="description" type="text" class="form-control" rows="10" placeholder="وصف ملف الاكسبرت"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">السماح بمعاينة الملف و تحميلة</span>
                                    </div>
                                    <select name="allow" class="form-control">
                                        <option value="0"> غير مسموح  </option>
                                        <option value="1"> مسموح </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 section-image">
                                <upload-attachment :savedfiles="[]"></upload-attachment>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group container-button">
                                    <button type="submit" class="btn btn-success">
                                        اضافة ملف الاكسبرت
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

