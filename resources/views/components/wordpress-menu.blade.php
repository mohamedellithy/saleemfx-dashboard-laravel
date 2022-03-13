<!-- @endforeach-->
<!--    @php $menu = Corcel\Model\Menu::slug('header')->first()->items ?? null; @endphp-->
<!--    @if($menu)-->
<!--        @forelse ($menu->reverse() as $item)-->
<!--            @if($loop->index != 0)-->
<!--                @if($loop->index != 1)-->
<!--                    @if(!empty($item->instance()->title))-->
                        
<!--                        <tr>-->
<!--                            <td>1.</td>-->
<!--                            @if($item->instance()->link_text)-->
<!--                                <td>رابط {!! $item->instance()->title ?? '' !!}</td>-->
<!--                            @else-->
<!--                                <td>رابط {!! $item->instance()->title ?? '' !!}</td>-->
<!--                            @endif-->
<!--                            <td>-->
<!--                                @if($item->instance()->link_text)-->
<!--                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ url($item->instance()->url ?? '#') }}">-->
<!--                                @else-->
<!--                                    <input name="settings[{{ $setting->name }}]" type="url" class="form-control" value="{{ url(Corcel\Model\Option::get('siteurl').'/'.$item->instance()->slug) }}">-->
<!--                                @endif-->
<!--                            </td>-->
<!--                        </tr>-->
    
<!--                    @endif-->
<!--                @endif-->
<!--            @endif-->
<!--        @empty-->
<!--        @endforelse-->
<!--    @endif-->
<!--@endforeach-->