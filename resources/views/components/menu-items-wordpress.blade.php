<div class="menu-items-all">
      @php $menu = Corcel\Model\Menu::slug('header')->first()->items ?? null; @endphp
     <ul class="menu-items">
        @if($menu)
            @forelse ($menu->reverse() as $item)
                @if($loop->index != 0)
                    @if($loop->index != 1)
                        @if(!empty($item->instance()->title))
                            <li class="dashboard-name-menu">
                                @if($item->instance()->link_text)
                                   <a level="{{ $loop->index ?? '' }}" href="{{ url($item->instance()->url ?? '#') }}">  {!! $item->instance()->title ?? '' !!} </a>
                                @else
                                   <a level="{{ $loop->index ?? '' }}" href="{{ url(Corcel\Model\Option::get('siteurl').'/'.$item->instance()->slug) }}">  {!! $item->instance()->title ?? '' !!} </a>
                                @endif
                                
                            </li>
                        @endif
                    @endif
                @endif
            @empty
            @endforelse
            @if(!auth()->user())
                <li class="dashboard-name-menu login-register-item">
                    <a href="{{ route('login') }}">  تسجيل الدخول </a>
                </li>
                <li class="dashboard-name-menu login-register-item">
                    <a href="{{ route('register') }}">  انشاء حساب </a>
                </li>
            @endif
        @endif
    </ul>
    <div class="mobile-menu">
        <ul class="menu-items-mobile">
            @if($menu)
                @forelse ($menu->reverse() as $item)
                    @if($loop->index != 0)
                        @if($loop->index != 1)
                            @if(!empty($item->instance()->title))
                                <li class="dashboard-name-menu">
                                    @if($item->instance()->link_text)
                                       <a level="{{ $loop->index ?? '' }}" href="{{ url($item->instance()->url ?? '#') }}">  {!! $item->instance()->title ?? '' !!} </a>
                                    @else
                                       <a level="{{ $loop->index ?? '' }}" href="{{ url(Corcel\Model\Option::get('siteurl').'/'.$item->instance()->slug) }}">  {!! $item->instance()->title ?? '' !!} </a>
                                    @endif
                                    
                                </li>
                            @endif
                        @endif
                    @endif
                @empty
                @endforelse
               
            @endif
        </ul>
    </div>
    
</div>