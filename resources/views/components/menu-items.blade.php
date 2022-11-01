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
    <div class="dropdown language-dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo app()->getlocale(); ?>
            @if(app()->getlocale() == 'ar')
               اللغة العربية
               <img src="https://cdn.britannica.com/79/5779-004-DC479508/Flag-Saudi-Arabia.jpg" style="width:20px;height:20px">
            @else
                English
                <img src="https://miro.medium.com/max/1400/0*o0-6o1W1DKmI5LbX.png" style="width:20px;height:20px">
            @endif
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @if(app()->getlocale() == 'ar')
                <a class="dropdown-item" href="{{ url('switch/en') }}">
                    English
                    <img src="https://miro.medium.com/max/1400/0*o0-6o1W1DKmI5LbX.png" style="width:20px;height:20px">
                </a>
            @else
                <a class="dropdown-item" href="{{ url('switch/ar') }}">
                    اللغة العربية
                    <img src="https://cdn.britannica.com/79/5779-004-DC479508/Flag-Saudi-Arabia.jpg" style="width:20px;height:20px">
                </a>
            @endif
        </div>
    </div>
    @if(!auth()->user())
        <li class="dashboard-name-menu login-register-item ">
            <a href="{{ route('login') }}">  تسجيل الدخول </a>
        </li>
        <li class="dashboard-name-menu login-register-item ">
            <a href="{{ route('register') }}">  انشاء حساب </a>
        </li>
    @endif
</ul>
