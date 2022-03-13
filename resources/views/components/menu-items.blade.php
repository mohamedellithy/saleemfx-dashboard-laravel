<ul class="menu-items">
    @if(!empty(Options()->setting['link_home']))
        <li class="dashboard-name-menu">
            <a href="{{ Options()->setting['link_home'] }}"> الرئيسية </a>
        </li>
    @endif
    @if(!empty(Options()->setting['link_services']))
        <li class="dashboard-name-menu">
            <a href="{{ Options()->setting['link_services'] }}"> خدماتنا </a>
        </li>
    @endif
    @if(!empty(Options()->setting['link_about_us']))
        <li class="dashboard-name-menu">
            <a href="{{ Options()->setting['link_about_us'] }}"> من نحن </a>
        </li>
    @endif
    @if(!empty(Options()->setting['link_videos']))
        <li class="dashboard-name-menu">
            <a href="{{ Options()->setting['link_videos'] }}"> الفيديو </a>
        </li>
    @endif
    @if(!empty(Options()->setting['link_technichal_analysis']))
        <li class="dashboard-name-menu">
            <a href="{{ Options()->setting['link_technichal_analysis'] }}"> التحليل الفني </a>
        </li>
    @endif
    @if(!empty(Options()->setting['link_blogs']))
        <li class="dashboard-name-menu">
            <a href="{{ Options()->setting['link_blogs'] }}"> المدونة </a>
        </li>
    @endif
    @if(!empty(Options()->setting['link_courses']))
        <li class="dashboard-name-menu">
            <a href="{{ Options()->setting['link_courses'] }}"> الأكاديمية </a>
        </li>
    @endif
    @if(!empty(Options()->setting['link_economic_news']))
        <li class="dashboard-name-menu">
            <a href="{{ Options()->setting['link_economic_news'] }}"> الأخبار الاقتصادية </a>
        </li>
    @endif
    @if(!empty(Options()->setting['link_contact_us']))
        <li class="dashboard-name-menu">
            <a href="{{ Options()->setting['link_contact_us'] }}"> اتصل بنا </a>
        </li>
    @endif
    @if(!empty(Options()->setting['link_be_partner']))
        <li class="dashboard-name-menu">
            <a href="{{ Options()->setting['link_be_partner'] }}"> كن شريكا </a>
        </li>
    @endif
    @if(!auth()->user())
        <li class="dashboard-name-menu login-register-item ">
            <a href="{{ route('login') }}">  تسجيل الدخول </a>
        </li>
        <li class="dashboard-name-menu login-register-item ">
            <a href="{{ route('register') }}">  انشاء حساب </a>
        </li>
    @endif
</ul>
