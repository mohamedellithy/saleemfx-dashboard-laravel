@extends('master')

@section('content_header')
  عرض المسوقيين بالعمولة
@stop

@section('plugins.Select2', true)

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
                                            {{ $user->firstname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>الاسم الثانى</td>
                                        <td>
                                            {{ $user->firstname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>اسم المستخدم</td>
                                        <td>
                                            {{ $user->username }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>البريدالالكترونى</td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>الدولة</td>
                                        <td>
                                            {{ $user->country }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>رقم الجوال</td>
                                        <td>
                                            {{ $user->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7.</td>
                                        <td>رقم حساب التليجرام</td>
                                        <td>
                                            {{ $user->telegram_number }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8.</td>
                                        <td col="3">الخدمات المشترك بها</td>
                                        <td>
                                            @forelse($user->services_orders as $services_orders)
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
                                            <p class="badge bg-danger" style="font-size: 100%;"> {{ $user->vip_order() ? 'مشترك فى خدمة ال vip':'غير مشترك فى الخدمة' }} </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>10.</td>
                                        <td> رصيد المستخدم</td>
                                        <td>
                                            <p class="badge bg-warning" style="font-size: 100%;"> {{ amount_currency($user->total_balance()) }} </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>10.</td>
                                        <td> المرتبات</td>
                                        <td>
                                            <p class="badge bg-warning" style="font-size: 100%;"> {{ amount_currency($user->affiliates->value_salaries()) }} </p>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>10.</td>
                                        <td> قيمة العمولة</td>
                                        <td>
                                            <p class="badge bg-warning" style="font-size: 100%;"> {{ amount_currency($user->affiliates->value_comissions()) }} </p>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>10.</td>
                                        <td> رصيد التسويق بالعمولة</td>
                                        <td>
                                            <p class="badge bg-warning" style="font-size: 100%;"> {{ amount_currency($user->affiliates->value_profits()) }} </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                         <!-- /.card-body -->
                    </div>
                </div><!-- /.card -->
                
                
                 <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0"> العملاء المدعويين</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body  p-0">
                            <table class="table table-striped">
                                <tbody>

                                    @forelse($user->affiliates->affiliatees as $affiliater)
                                        <tr>
                                            <td>{{ $affiliater->email }}</td>
                                            <td>{{ $affiliater->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr class="">
                                            <td colspan="2"> لايوجد اى عملاء </td>
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

                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0"> التسويق بالعمولة</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body  p-0">
                            <form method="post" action="{{ url('affiliater-commission',['id'=>$user->affiliates->id]) }}">
                                @csrf()
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>عمولة التسويق بالعمولة بالنسبة</td>
                                            <td>
                                                <input class="form-control" type="number" name="commission_value" value="{{ $user->affiliates->commission_value ?? Options()->setting['affiliate_value'] }}" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button type="submit" class="btn btn-primary"> حفظ التغيرات </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0"> تحديد مسؤلية المسوق</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body  p-0">
                            <form method="post" action="{{ url('change-affiliter-position',['id'=>$user->affiliates->id]) }}">
                                @csrf()
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>مسؤلية المسوق</td>
                                            <td>
                                                <select name="position" class="form-control ">
                                                    <option value="0" {{ $user->affiliates->employee == 0 ? 'selected' : '' }}> مسوق بالعمولة </option>
                                                    <option value="1" {{ $user->affiliates->employee == 1 ? 'selected' : '' }}> مسوق موظف </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button type="submit" class="btn btn-success"> حفظ التغيرات </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                
                @if($user->affiliates->employee == 1)
                
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0"> اضافة راتب للموظف</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body  p-0">
                            <form method="post" action="{{ url('add-salary-employee',['id'=>$user->affiliates->id]) }}">
                                @csrf()
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>مبلغ الراتب</td>
                                            <td>
                                                <input class="form-control" type="number" name="value" value="0" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button type="submit" class="btn btn-info"> اضافة الراتب </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                
                
                <div class="card card-primary card-outline">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">رواتب المسوقين الموظفين</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <tbody>
                                    @forelse($user->affiliates->employee_salaries as $salary)
                                        <tr>
                                            <td>{{ $loop->index }}.</td>
                                            <td>{{ amount_currency($salary->value) }}</td>
                                            <td>
                                                {{ $salary->created_at }}
                                            </td>
                                            <td>
                                               <a href="{{ url('delete-employee-salary',['id'=>$salary->id]) }}" class="btn btn-danger"> حذف الراتب </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                 فير متوفرة
                                            </td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                         <!-- /.card-body -->
                    </div>
                </div><!-- /.card -->
                @endif
            </div>
          <!-- /.col-md-6 -->
        </div>
@endsection


