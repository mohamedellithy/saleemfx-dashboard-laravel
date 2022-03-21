@component('mail::message')
#  اضافة حساب جديد فى منصة سليم للتداول

لقد تم اضافة حساب تداول جديد داخل منصة سليم للتداول
## {{ auth()->user()->email ?? auth()->user()->name  }}

@component('mail::button', ['url' => url('accounts')])
قم بمراجعة الحساب الان
@endcomponent

@component('mail::button', ['url' => url('users/'.auth()->user()->id)])
مراجعة الحساب الخاص بالمشترك
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
