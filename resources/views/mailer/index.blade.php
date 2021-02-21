@extends('layouts.page')

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="item"><span itemprop="name">{{__('ui.mailer')}}</span></span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <aside class="side">
            <a href="#side-block" data-fancybox class="side-mob">{{__('ui.cabinet')}}</a>
            <div class="side-block" id="side-block">
                <div class="side-title">{{__('ui.cabinet')}}</div>
                <ul class="side-list">
                    <li><a href="{{loc_url(route('profile'))}}">{{__('ui.profileInfo')}}</a></li>
                    <li><a href="{{loc_url(route('mailer.index'))}}" class="active">{{__('ui.mailer')}}</a></li>
                    <li><a href="{{loc_url(route('profile.subscription'))}}">{{__('ui.mySubscription')}}</a></li>
                    <li><a href="{{loc_url(route('profile.posts'))}}">{{__('ui.myPosts')}}</a></li>
                    <li><a href="{{loc_url(route('profile.favourites'))}}">{{__('ui.favourites')}}</a></li>
                    <li><a href="#" onclick="document.getElementById('logout-form').submit();">{{__('ui.signOut')}}</a></li>
                    <form id="logout-form" action="{{ loc_url(route('logout')) }}" method="POST" hidden>@csrf</form>
                </ul>
            </div>
            <div class="side-add side-add-mailing">
                <div class="side-add-text">{{__('ui.mailerHowToCreate')}}</div>
                <div class="side-add-icon"><img src="{{asset('icons/mailing-icon.svg')}}" alt=""></div>
                <a href="{{loc_url(route('faq'))}}#HowToCreateMailer" class="button">{{__('ui.see')}}</a>
            </div>
        </aside>
        <div class="content">
            <h1>{{__('ui.mailer')}} (<span class="orange">{{$mailers->count()}}</span>)</h1>
            @if ($mailers->isNotEmpty())
                <div class="cabinet-line">
                    <div class="cabinet-search">
                    </div>
                    <div class="cabinet-line-right">
                        <a href="#popup-delete-all-mailers" class="cabinet-line-link" data-fancybox>{{__('ui.mailerDeleteAll')}}</a>
                        <a href="{{loc_url(route('mailers.deactivate'))}}" class="cabinet-line-link">{{__('ui.mailerDeactivateAll')}}</a>
                    </div>
                </div>
                <div class="mailing">
                    @foreach ($mailers as $m)
                        <div class="mailing-item id_{{$m->id}}">
                            <div class="mailing-title">{{$m->title}}</div>
                            <div class="mailing-status current {{$m->is_active ? 'status-active' : 'status-disabled'}}">{{$m->is_active ? __('ui.active') : __('ui.notActive')}}</div>
                            <div class="mailing-status status-passive"><a href="">{{$m->is_active ? __('ui.deactivate') : __('ui.activete')}}</a></div>
                            <div class="mailing-info">
                                @if (!$m->tag && !$m->author && !$m->keyword)
                                    <div class="mailing-info-item">
                                        <div class="mailing-info-name">{{__('ui.setting')}}:</div>
                                        <div class="mailing-info-text"><a href="{{loc_url(route('list'))}}">{{__('ui.mailerAllPosts')}}</a></div>
                                    </div>
                                @endif
                                @if ($m->author)
                                    <div class="mailing-info-item">
                                        <div class="mailing-info-name">{{__('ui.author')}}:</div>
                                        <div class="mailing-info-text"><a href="{{loc_url(route('search', ['author'=>$m->author_url_name]))}}">{{$m->author_name}}</a></div>
                                    </div>
                                @endif
                                @if ($m->tag)
                                    <div class="mailing-info-item">
                                        <div class="mailing-info-name">{{__('ui.tag')}}:</div>
                                        <div class="mailing-info-text">
                                            <ul class="form-category-list">
                                                @foreach ($m->tag_map as $id=>$t)
                                                    <li><a href="{{loc_url(route('tag-'.$id))}}">{{$t}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                @if ($m->keyword)
                                    <div class="mailing-info-item">
                                        <div class="mailing-info-name">{{__('ui.mailerKeyword')}}:</div>
                                        <div class="mailing-info-text mailer-keywords"><a href="" class="link">{{$m->keyword}}</a>
                                            <form action="{{loc_url(route('search'))}}" hidden>
                                                <input type="text" name="text" value="{{$m->keyword}}">
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                @if ($m->cost_from || $m->cost_to)
                                    <div class="mailing-info-item">
                                        <div class="mailing-info-name">{{__('ui.cost')}}:</div>
                                        <div class="mailing-info-text">{{$m->cost_from_readable}} - {{$m->cost_to_readable}}</div>
                                    </div>
                                @endif
                                @if ($m->region || $m->region!=0)
                                    <div class="mailing-info-item">
                                        <div class="mailing-info-name">{{__('ui.region')}}:</div>
                                        <div class="mailing-info-text">{{$m->region_name}}</div>
                                    </div>
                                @endif
                                @if (!$m->all_conditions)
                                    <div class="mailing-info-item">
                                        <div class="mailing-info-name">{{__('ui.condition')}}:</div>
                                        <div class="mailing-info-text">{{$m->conditions_readable}}</div>
                                    </div>
                                @endif
                                @if (!$m->all_types)
                                    <div class="mailing-info-item">
                                        <div class="mailing-info-name">{{__('ui.type')}}:</div>
                                        <div class="mailing-info-text">{{$m->types_readable}}</div>
                                    </div>
                                @endif
                                @if (!$m->all_roles)
                                    <div class="mailing-info-item">
                                        <div class="mailing-info-name">{{__('ui.postRole')}}:</div>
                                        <div class="mailing-info-text">{{$m->roles_readable}}</div>
                                    </div>
                                @endif
                                @if (!$m->all_threads)
                                    <div class="mailing-info-item">
                                        <div class="mailing-info-name">{{__('ui.thread')}}:</div>
                                        <div class="mailing-info-text">{{$m->threads_readable}}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="bar">
                                <div class="bar-icons">
                                    <a href="{{loc_url(route('mailer.edit', ['mailer'=>$m->id]))}}" class="bar-edit">
                                        <svg viewBox="0 0 401 398.99" xmlns="http://www.w3.org/2000/svg">
                                            <path transform="translate(0)" d="M370.11,250.39a10,10,0,0,0-10,10v88.68a30,30,0,0,1-30,30H49.94a30,30,0,0,1-30-30V88.8a30,30,0,0,1,30-30h88.67a10,10,0,1,0,0-20H49.94A50,50,0,0,0,0,88.8V349.05A50,50,0,0,0,49.94,399H330.16a50,50,0,0,0,49.93-49.94V260.37a10,10,0,0,0-10-10"/>
                                            <path transform="translate(0)" d="M376.14,13.16a45,45,0,0,0-63.56,0L134.41,191.34a10,10,0,0,0-2.57,4.39l-23.43,84.59a10,10,0,0,0,12.29,12.3l84.59-23.44a10,10,0,0,0,4.4-2.56L387.86,88.44a45,45,0,0,0,0-63.56Zm-220,184.67L302,52l47,47L203.19,244.86Zm-9.4,18.85,37.58,37.58-52,14.39Zm227-142.36-10.6,10.59-47-47,10.6-10.59a25,25,0,0,1,35.3,0L373.74,39a25,25,0,0,1,0,35.31"/>
                                        </svg>	
                                    </a>
                                    <a href="#popup-delete-mailer" class="bar-delete id_{{$m->id}}" data-fancybox>
                                        <svg viewBox="0 0 418.17 512" xmlns="http://www.w3.org/2000/svg">
                                            <path transform="translate(0)" d="M416.88,114.44,405.57,80.55A31.52,31.52,0,0,0,375.63,59h-95V28a28.06,28.06,0,0,0-28-28h-87a28.06,28.06,0,0,0-28,28V59h-95A31.54,31.54,0,0,0,12.6,80.55L1.3,114.44a25.37,25.37,0,0,0,24.06,33.4H37.18l26,321.6A46.54,46.54,0,0,0,109.29,512H314.16a46.52,46.52,0,0,0,46.1-42.56l26-321.6h6.54a25.38,25.38,0,0,0,24.07-33.4M167.56,30h83.06V59H167.56Zm162.8,437a16.36,16.36,0,0,1-16.2,15H109.29a16.36,16.36,0,0,1-16.2-15L67.27,147.84h288.9ZM31.79,117.84l9.27-27.79A1.56,1.56,0,0,1,42.55,89H375.63a1.55,1.55,0,0,1,1.48,1.07l9.27,27.79Z"/>
                                            <path transform="translate(0)" d="m282.52 466h0.79a15 15 0 0 0 15-14.22l14.09-270.4a15 15 0 0 0-30-1.56l-14.08 270.38a15 15 0 0 0 14.2 15.8"/>
                                            <path transform="translate(0)" d="m120.57 451.79a15 15 0 0 0 15 14.19h0.83a15 15 0 0 0 14.16-15.79l-14.75-270.4a15 15 0 1 0-30 1.63z"/>
                                            <path transform="translate(0)" d="M209.25,466a15,15,0,0,0,15-15V180.58a15,15,0,0,0-30,0V451a15,15,0,0,0,15,15"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>{{__('ui.noMailer')}}</p>
            @endif
        </div>
    </div>
@endsection

@section('modals')
    <div id="popup-delete-all-mailers" class="popup">
        <div class="popup-title">{{__('ui.sure?')}}</div>
        <div class="sure-dialog">
            <form method="POST" action="{{loc_url(route('mailers.delete'))}}">
                @csrf
                @method('DELETE')
                <button type="submit">{{__('ui.mailerDeleteAll')}}</button>
            </form>
        </div>
    </div>
    <div id="popup-delete-mailer" class="popup">
        <div class="popup-title">{{__('ui.sure?')}}</div>
        <div class="sure-dialog">
            <form method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="hidden">{{__("ui.deleteMailer")}}</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            //activate/deactivate mailer
            $('.status-passive a').click(function(e){
                e.preventDefault();
                var id = getIdFromClasses($(this).parent().parent().attr('class'), 'id_');
                var ajaxUrl = "{{ route('mailer.toggle', ['mailer'=>':mailerId']) }}";
                ajaxUrl = ajaxUrl.replace(':mailerId', id);
                var button = $(this);
                button.addClass('loading');
                $.ajax({
                    type: "POST",
                    url: ajaxUrl,
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        try {
                            var d = JSON.parse(data);
                            var curr = button.parent().parent().find('.mailing-status.current');
                            // codes: Bag Plan(-2), Bad Auth(-1), Diactivated(0), Activated(1)
                            switch (d) {
                                case -2:
                                    showPopUpMassage(false, "{{ __('messages.requireStandart') }}");
                                    break;
                                case -1:
                                    showPopUpMassage(false, "{{ __('messages.authError') }}");
                                    break;
                                case 0:
                                    curr.removeClass('status-active').addClass('status-disabled').text('{{__("ui.notActive")}}');
                                    button.text('{{__("ui.activete")}}');
                                    showPopUpMassage(true, "{{ __('messages.mailerDeactivated') }}");
                                    break;
                                case 1:
                                    curr.removeClass('status-disabled').addClass('status-active').text('{{__("ui.active")}}');
                                    button.text('{{__("ui.deactivate")}}');
                                    showPopUpMassage(true, "{{ __('messages.mailerActivated') }}");
                                    break;
                                default:
                                    showPopUpMassage(false, "{{ __('messages.error') }}");
                                    break;
                            }
                            button.removeClass('loading');
                        } catch (error) {
                            showPopUpMassage(false, "{{ __('messages.error') }}");
                        }
                    },
                    error: function(xhr, status, error) {
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                        button.removeClass('loading');
                    }
                });
            })

            //search keywords by click
            $('.mailer-keywords a').click(function(e){
                e.preventDefault();
                $('.mailer-keywords form').submit();
            });

            //create url of deletion of chosed mailer
            $('.bar-delete').click(function(){
                var mailerId = getIdFromClasses($(this).attr('class'), 'id_');
                var url = "{{route('mailer.destroy', ['mailer'=>':mailerId'])}}";
                url = url.replace(':mailerId', mailerId);
                $('#popup-delete-mailer form').attr('action', url);
                $('#popup-delete-mailer button[type=submit]').removeClass('hidden');
            });
        });
    </script>
@endsection