@extends('master')

@section('css')
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/Adminlte-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">

@stop


@section('content_header')
  اعدادات المنصة
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
            <div class="card card-primary card-outline">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">أعدادات المنصة</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">

                        <form method="post" action="{{ route('settings.store') }}">
                            @csrf()
                            <table class="table table-striped">
                                <tbody>
                                    @foreach($settings as $setting)
                                        @if($setting->name == 'max_cashback_withdraw')
                                            <tr>
                                                <td>1.</td>
                                                <td>الحد الاقصي لسحب الكاش باك</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="text" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'min_cashback_withdraw')
                                            <tr>
                                                <td>1.</td>
                                                <td>الحد الادنى لسحب الكاش باك</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="text" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'date_cashback_withdraw')
                                            <tr>
                                                <td>1.</td>
                                                <td>المدة المسموحة لسحب الكاش ( الاشهر )</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="text" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'currency')
                                            <tr>
                                                <td>1.</td>
                                                <td>العملة المستخدمة فى الموقع</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="text" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'telegram_channel_link')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط خاص بمجموعة التيليجرام للتوصيات</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'affiliate_value')
                                            <tr>
                                                <td>1.</td>
                                                <td>قيمة عمولة الافيليت</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="number" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif


                                        @if($setting->name == 'link_home')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط الرئيسية</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'link_services')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط خدماتنا</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'link_about_us')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط من نحن</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="text" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'link_videos')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط الفيديو</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'link_technichal_analysis')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط التحليل الفنى</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'link_blogs')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط المدونة</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'link_courses')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط الدورات</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'link_economic_news')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط الاخبار الاقتصادية</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                        @if($setting->name == 'link_contact_us')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط تواصل معنا</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif

                                         @if($setting->name == 'link_be_partner')
                                            <tr>
                                                <td>1.</td>
                                                <td>رابط كن شريكا</td>
                                                <td>
                                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ $setting->value }}">
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="3">
                                        <button type="submit" class="btn btn-success">حفظ الاعدادات <i class="fas fa-cogs "></i> </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('js')


    {{-- rtl bootstrap  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js" integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK" crossorigin="anonymous"></script>

    <script src="{{ asset('js/admin_custom.js') }}" ></script>
    <script> console.log('Hi!'); </script>

@stop


