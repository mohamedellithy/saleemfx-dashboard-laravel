@extends('master')

@section('content_header')
   تعديل حساب التداول
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
            <form method="post" action="{{ route('my-accounts.update',$account->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">تعديل حساب التداول</h3>
                    </div>
                    <div class="card-body" id="app">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">اسم شركة التداول بالعربي</span>
                                    </div>
                                    <input value="{{ $account->forex_company->name_ar ?? '' }}" type="text" class="form-control" placeholder="اسم شركه التداول" readonly>
                                </div>
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">اسم شركة التداول بالانجليزي</span>
                                    </div>
                                    <input value="{{ $account->forex_company->name_en ?? '' }}" type="text" class="form-control" placeholder="اسم شركه التداول" readonly>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">رقم حساب شركة التداول</span>
                                    </div>
                                    <input value="{{ $account->account_number ?? '' }}" type="text" class="form-control" placeholder="رقم حساب شركة التداول" readonly>
                                </div>
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">مبلغ التداول فى شركة الفوركس</span>
                                    </div>
                                   <input name="account_balance" value="{{ $account->account_balance ?? 0 }}" type="number" class="form-control" placeholder="مبلغ التداول فى شركة الفوركس">
                                </div>
                                
                            </div>

                            <div class="col-md-12">
                                <div class="input-group container-button">
                                    <button type="submit" class="btn btn-success">
                                       تعديل حساب التداول
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
