@extends('master')

@section('content_header')
  عرض المستخدمين
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
                            <h3 class="card-title">عرض بيانات المستخدم</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">

                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>الاسم الاول</td>
                                        <td>
                                            {{ $user_info->firstname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>الاسم الثانى</td>
                                        <td>
                                            {{ $user_info->firstname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>اسم المستخدم</td>
                                        <td>
                                            {{ $user_info->username }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>البريدالالكترونى</td>
                                        <td>
                                            {{ $user_info->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>الدولة</td>
                                        <td>
                                            {{ $user_info->country }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>رقم الجوال</td>
                                        <td>
                                            {{ $user_info->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7.</td>
                                        <td>رقم حساب التليجرام</td>
                                        <td>
                                            {{ $user_info->telegram_number }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8.</td>
                                        <td col="3">الخدمات المشترك بها</td>
                                        <td>
                                            @forelse($user_info->services_orders as $services_orders)
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
                                            <p class="badge bg-danger" style="font-size: 100%;"> {{ $user_info->vip_order() ? 'مشترك فى خدمة ال vip':'غير مشترك فى الخدمة' }} </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>10.</td>
                                        <td> رصيد المستخدم</td>
                                        <td>
                                            <p class="badge bg-warning" style="font-size: 100%;"> {{ amount_currency($user_info->total_balance()) }} </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                         <!-- /.card-body -->
                    </div>
                </div><!-- /.card -->

                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">حسابات الشركات</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body cashback_tables p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> اسم الشركة  </th>
                                        <th> رقم حساب الشركة  </th>
                                         <th> حالة الطلب  </th>
                                        <th> تاريخ الاشتراك  </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($user_info->accounts as $accounts)
                                        <tr>
                                            <td>{{ $accounts->forex_company->name_ar }}</td>
                                            <td>{{ $accounts->account_number ?? $cashback->account->forex_company->name_en  }}</td>
                                            <td>{!! $accounts->status_text !!}</td>
                                            <td>{{ $accounts->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"> لايوجد كاش باك فى حسابك </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                                            <p class="badge bg-warning" style="font-size: 100%;"> {{ amount_currency($user_info->total_balance()) }} </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>طلبات الشحن المفعلة</td>
                                        <td>
                                            {{ amount_currency($user_info->total_recharge()) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>كاش باك</td>
                                        <td>
                                            {{ amount_currency($user_info->total_cashback()) }}
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>2.</td>
                                        <td>عمليات السحب من الرصيد</td>
                                        <td>
                                            {{ amount_currency($user_info->total_withdraws()) }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">الكاش باك</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body cashback_tables p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> قيمة الكاش باك  </th>
                                        <th> شركة التابع لها الحساب  </th>
                                        <th> اشهر الحساب  </th>
                                        <th> تاريخ اضافة الكاش باك  </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($user_info->cashbacks()->orderBy('month','desc')->get() as $cashback)
                                        <tr>
                                            <td>{{ amount_currency($cashback->value) }}</td>
                                            <td>{{ $cashback->account->forex_company->name_ar ?? $cashback->account->forex_company->name_en  }}</td>
                                            <td>{{ $cashback->month ? $cashback->month : '' }}</td>
                                            <td>{{ $cashback->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4"> لايوجد كاش باك فى حسابك </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

               
          <!-- /.col-md-6 -->
        </div>
@endsection
