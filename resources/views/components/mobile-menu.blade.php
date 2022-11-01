<div class="mobile-menu">
    <ul class="menu-items-mobile">
        @if(!empty(Options()->setting['link_home']))
            <li class="dashboard-name-menu">
                <a href="{{ Options()->setting['link_home'] }}"> {{ __('master.home') }} </a>
            </li>
        @endif
        @if(!empty(Options()->setting['link_services']))
            <li class="dashboard-name-menu">
                <a href="{{ Options()->setting['link_services'] }}">  {{ __('master.services') }}  </a>
            </li>
        @endif
        @if(!empty(Options()->setting['link_about_us']))
            <li class="dashboard-name-menu">
                <a href="{{ Options()->setting['link_about_us'] }}"> {{ __('master.about-us') }} </a>
            </li>
        @endif
        @if(!empty(Options()->setting['link_videos']))
            <li class="dashboard-name-menu">
                <a href="{{ Options()->setting['link_videos'] }}"> {{ __('master.videos') }} </a>
            </li>
        @endif
        @if(!empty(Options()->setting['link_technichal_analysis']))
            <li class="dashboard-name-menu">
                <a href="{{ Options()->setting['link_technichal_analysis'] }}"> {{ __('master.analysis') }} </a>
            </li>
        @endif
        @if(!empty(Options()->setting['link_blogs']))
            <li class="dashboard-name-menu">
                <a href="{{ Options()->setting['link_blogs'] }}"> {{ __('master.blog') }} </a>
            </li>
        @endif
        @if(!empty(Options()->setting['link_courses']))
            <li class="dashboard-name-menu">
                <a href="{{ Options()->setting['link_courses'] }}"> {{ __('master.academy') }} </a>
            </li>
        @endif
        @if(!empty(Options()->setting['link_economic_news']))
            <li class="dashboard-name-menu">
                <a href="{{ Options()->setting['link_economic_news'] }}"> {{ __('master.economic-news') }} </a>
            </li>
        @endif
        @if(!empty(Options()->setting['link_contact_us']))
            <li class="dashboard-name-menu">
                <a href="{{ Options()->setting['link_contact_us'] }}"> {{ __('master.contact-us') }}</a>
            </li>
        @endif
        @if(!empty(Options()->setting['link_be_partner']))
            <li class="dashboard-name-menu">
                <a href="{{ Options()->setting['link_be_partner'] }}"> {{ __('master.be-partner') }}</a>
            </li>
        @endif
    </ul>
</div>