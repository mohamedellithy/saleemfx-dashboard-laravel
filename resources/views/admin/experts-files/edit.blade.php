@extends('master')

@section('content_header')
   تعديل شركة التداول
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
            <form method="post" action="{{ route('experts-files.update',$experts_files->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">تعديل شركة التداول</h3>
                    </div>
                    <div class="card-body" id="app">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">اسم ملف الاكسبرت</span>
                                    </div>
                                    <input name="name" value="{{ $experts_files->name ?? '' }}" type="text" class="form-control" placeholder="اسم ملف الاكسبرت">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">وصف ملف الاكسبرت</span>
                                    </div>
                                    <textarea name="description" type="text" class="form-control" rows="10" placeholder="وصف ملف الاكسبرت">{{ $experts_files->description ?? '' }}</textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">السماح بمعاينة الملف و تحميلة</span>
                                    </div>
                                    <select name="allow" class="form-control">
                                        <option value="0" {{ $experts_files->allow == 0 ? 'selected' : '' }}> غير مسموح  </option>
                                        <option value="1" {{ $experts_files->allow == 1 ? 'selected' : '' }}> مسموح </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 section-image">
                                <upload-attachment :savedfiles="{{ $attachments ? $attachments->toJson() : [] }}"></upload-attachment>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group container-button">
                                    <button type="submit" class="btn btn-success">
                                        تعديل ملف الاكسبرت
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
