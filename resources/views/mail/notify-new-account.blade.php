@component('mail::message')
#  انضمام عميل جديد لمنصة سليم للتداول

لقد تم انضمام عضو جديد داخل منصة سليم للتداول
## {{ auth()->user()->email ?? auth()->user()->name  }}

<br>
@component('mail::button', ['url' => url('users/'.auth()->user()->id)])
مراجعة الحساب الخاص بالعضو
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
