@component('mail::message') 
#  دعوة لتجربة منصة سليم للتداول 

لقد تم دعوتك من قبل 
## {{ auth()->user()->email ?? auth()->user()->name  }} 
لتجربة منصة سليم لتداول الفوركس وهى أكبر منصة فى الشرق الأوسط للتداول و تقديم الاستشارات المالية و الفوركس

@component('mail::button', ['url' => url('register?reference_id='.auth()->user()->affiliates->code_affiliate)])
قم بالتسجيل الان و ابدأ فى تجارتك
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
