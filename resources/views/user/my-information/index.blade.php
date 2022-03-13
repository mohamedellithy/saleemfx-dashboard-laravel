@extends('master')

@section('content_header')
  عرض بياناتى
@stop

@push('css')
   <style>
        .cashback_tables{
          height: 300px;
          overflow-y: auto;
        }
   </style>
@endpush

@section('content')
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">عرض بياناتي</h3>
                        </div>
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
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <form method="post" action="{{ url('update-info') }}">
                                @csrf 
                            <table class="table table-striped">

                                <tbody>
                                    <tr>
                                        
                                        <td>الاسم الاول</td>
                                        <td>
                                            <input class="form-control" type="text" name="firstname" value="{{ auth()->user()->firstname }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>الاسم الثانى</td>
                                        <td>
                                            <input class="form-control" type="text" name="lastname" value="{{ auth()->user()->lastname }}" required />
                                        </td>
                                    </tr>
                                    <tr>
                                       
                                        <td>اسم المستخدم</td>
                                        <td>
                                            <input class="form-control" type="text" name="username" value="{{ auth()->user()->username }}"required />
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>البريدالالكترونى</td>
                                        <td>
                                            <input class="form-control" type="email" name="email" value="{{ auth()->user()->email }}" readonly/>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td>رقم الجوال</td>
                                        <td>
                                            <input class="form-control" type="tel" name="phone" value="{{ auth()->user()->phone }}" required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>رقم حساب التليجرام</td>
                                        <td>
                                            <input class="form-control" type="tel" name="telegram_number" value="{{ auth()->user()->telegram_number }}" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td colspan="2">
                                            <button class="btn btn-success" type="submit" > تحديث المعلومات</button>
                                        </td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                            </form>
                        </div>
                         <!-- /.card-body -->
                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">التفاصيل المالية و طلبات الشحن</h5>
                    </div>
                    <div class="card-body">
                     <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>10.</td>
                                        <td> رصيد المتاح</td>
                                        <td>
                                            <p class="badge bg-warning" style="font-size: 100%;"> {{ auth()->user()->total_balance() }} </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>طلبات الشحن المفعلة</td>
                                        <td>
                                            {{ auth()->user()->total_recharge() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>كاش باك</td>
                                        <td>
                                            {{ auth()->user()->total_cashback() }}
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>2.</td>
                                        <td>عمليات السحب من الرصيد</td>
                                        <td>
                                            {{ auth()->user()->total_withdraws() }}
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>8.</td>
                                        <td col="3">الخدمات المشترك بها</td>
                                        <td>
                                            @forelse(auth()->user()->services_orders as $services_orders)
                                                <p class="btn btn-info btn-flat">{{ $services_orders->services->post_title }}</p>
                                            @empty
                                                <p> غير مشترك فى اى خدمة </p>
                                            @endforelse
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>9.</td>
                                        <td> خدمة vip</td>
                                        <td>
                                            <p class="badge bg-danger" style="font-size: 100%;"> {{ auth()->user()->vip_order() ? 'مشترك فى خدمة ال vip':'غير مشترك فى الخدمة' }} </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>10.</td>
                                        <td> رصيد المستخدم</td>
                                        <td>
                                            <p class="badge bg-warning" style="font-size: 100%;"> {{ auth()->user()->total_balance() }} </p>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

          <!-- /.col-md-6 -->
        </div>
@endsection
