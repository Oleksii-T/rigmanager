@extends('layouts.page')

@section('meta')
	<title>{{$post->title_localed . ' - ' . $post->tag_map[array_key_last($post->tag_map)] . ' ' . __('meta.title.post.show')}}</title>
	<meta name="description" content="{{($post->cost ? $post->cost_readable : '') . ': ' . (strlen($post->description_localed)>90 ? substr($post->description_localed, 0, 90) . '...' : $post->description_localed)}}">
    <meta name="robots" content="index, follow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="{{loc_url(route('catalog'))}}"><span itemprop="name">{{__('ui.catalog')}}</span></a>
        <meta itemprop="position" content="2" />
    </li>
    @foreach ($post->tag_map as $id => $tag)
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="{{loc_url(route('tag-'.$id))}}"><span itemprop="name">{{$tag}}</span></a>
            <meta itemprop="position" content="{{$loop->index+3}}" />
        </li>
        @if ($loop->last)
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name">{{$post->title_localed}}</span>
                <meta itemprop="position" content="{{$loop->index+4}}" />
            </li>
        @endif
    @endforeach
@endsection

@section('content')
    @if (!$post->is_active)
        <div class="outdated-post-alert">
            <p>{{__('ui.postIsHidden')}}</p>
        </div>
    @endif
    <div class="prod">
        <div class="prod-content">
            <div class="prod-top">
                <a href="" class="catalog-fav add-to-fav id_{{$post->id}} {{Auth::check() ? '' : 'auth-block'}} {{Auth::check() && $post->user_id == auth()->user()->id ? 'block' : ''}} {{Auth::check() && auth()->user()->favPosts->contains($post) ? 'active' : ''}}">
                    <svg viewBox="0 0 464 424" xmlns="http://www.w3.org/2000/svg">
                        <path class="cls-1" d="M340,0A123.88,123.88,0,0,0,232,63.2,123.88,123.88,0,0,0,124,0C55.52,0,0,63.52,0,132,0,304,232,424,232,424S464,304,464,132C464,63.52,408.48,0,340,0Z"/>
                    </svg>
                    {{__('ui.addToFav')}}
                </a>
                @if ( $post->images->isNotEmpty() )
                    <div class="prod-controls">
                        <a href="" class="prod-arrow prod-prev"></a>
                        <div class="prod-current"></div>
                        <div class="prod-divider"></div>
                        <div class="prod-all"></div>
                        <a href="" class="prod-arrow prod-next"></a>
                    </div>
                @endif
            </div>
            @if ( $post->images->isNotEmpty() )
                <div class="prod-photo">
                    @foreach ($post->images->where('version', 'origin') as $image)
                        <div class="prod-photo-slide">
                            <a href="{{$image->url}}" data-fancybox="prod"><img src="{{$image->url}}" alt=""></a>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="prod-about">
                @if (!App::isLocale($post->origin_lang))
                    <div class="warning">{{__('ui.originPostLang')}} <a class="show-origin-text" href="">{{$post->origin_lang_readable}}</a>.</div>
                    <h1>{{$post->title_localed}}</h1>
                    <p>{{$post->description_localed}}</p>
                    <h1 class="hidden">{{$post->title}}</h1>
                    <p class="hidden">{{$post->description}}</p>
                @else
                    <h1>{{$post->title}}</h1>
                    <p>{{$post->description}}</p>
                @endif
            </div>
        </div>
        <div class="prod-side">
            <div class="prod-author">
                <div class="prod-author-info">
                    @if ($post->user->image)
                        <div class="prod-author-ava" style="background-image: url({{$post->user->image->url}})"></div>
                    @else
                        <div class="prod-author-ava" style="background-image: url({{asset('icons/emptyAva.svg')}})"></div>
                    @endif
                    <div class="prod-author-about">
                        <div class="prod-author-name">{{$post->user->name}}</div>
                        <a href="{{loc_url(route('search', ['author'=>$post->user->url_name]))}}" class="prod-author-link">{{__('ui.allAuthorPosts')}}</a>
                        @auth
                            <br>
                            @if ($post->user_id != Auth::id())
                                @if (auth()->user()->mailers && auth()->user()->mailers->pluck('author')->contains($post->user_id))
                                    <a href="" class="prod-author-link add-to-mailer">{{__('ui.mailerAuthorAlreadyAdded')}}</a>
                                @else
                                    <a href="" class="prod-author-link add-to-mailer">{{__('ui.mailerAddAuthor')}}</a>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
                <a href="#popup-contacts" data-fancybox class="button button-light show-contacts">{{__('ui.showContacts')}}</a>
                @if (Auth::check() && $post->user_id==Auth::id())
                    <br>
                    <a href="{{loc_url(route('posts.edit', ['post'=>$post->url_name]))}}" class="button button-light">{{__('ui.edit')}}</a>
                @endif
            </div>
            @if ($post->doc)
                <div class="prod-info">
                    <div class="prod-info-title">{{__('ui.attDoc')}}</div>
                    <div class="prod-info-item prod-doc">
                        <div class="prod-info-text"><span class="orange">{{$post->doc_name}}</span></div>
                        <a href="{{route('download.post.doc', ['post'=>$post->id])}}" class="button button-blue">{{__('ui.download')}}</a>
                    </div>
                </div>
            @endif
            <div class="prod-info">
                <div class="prod-info-title">{{__('ui.info')}}</div>
                @if ($post->is_urgent)
                    <div class="prod-info-item">
                        <div class="prod-info-text"><span class="orange">{{__('ui.urgent')}}</span></div>
                    </div>
                @endif
                @if ($post->is_import)
                    <div class="prod-info-item">
                        <div class="prod-info-text"><span class="orange">{{__('ui.import')}}</span></div>
                    </div>
                @endif
                <div class="prod-info-item">
                    <div class="prod-info-name">{{__('ui.postType')}}</div>
                    <div class="prod-info-text">{{$post->type_readable}}</div>
                </div>
                <div class="prod-info-item">
                    <div class="prod-info-name">{{__('ui.postRole')}}</div>
                    <div class="prod-info-text">{{$post->role_readable}}</div>
                </div>
                @if ($post->company)
                    <div class="prod-info-item">
                        <div class="prod-info-name">{{__('ui.company')}}</div>
                        <div class="prod-info-text">{{$post->company}}</div>
                    </div>
                @endif
                @if ($post->amount)
                    <div class="prod-info-item">
                        <div class="prod-info-name">{{__('ui.amount')}}</div>
                        <div class="prod-info-text">{{$post->amount}}</div>
                    </div>
                @endif
                @if ($post->condition)
                    <div class="prod-info-item">
                        <div class="prod-info-name">{{__('ui.condition')}}</div>
                        <div class="prod-info-text">{{$post->condition_readable}}</div>
                    </div>
                @endif
                @if ($post->manufacturer)
                    <div class="prod-info-item">
                        <div class="prod-info-name">{{__('ui.manufacturer')}}</div>
                        <div class="prod-info-text">{{$post->manufacturer}}</div>
                    </div>
                @endif
                @if ($post->manufactured_date)
                    <div class="prod-info-item">
                        <div class="prod-info-name">{{__('ui.manufacturedDate')}}</div>
                        <div class="prod-info-text">{{$post->manufactured_date}}</div>
                    </div>
                @endif
                @if ($post->part_number)
                    <div class="prod-info-item">
                        <div class="prod-info-name">{{__('ui.partNum')}}</div>
                        <div class="prod-info-text">{{$post->part_number}}</div>
                    </div>
                @endif
                @if ($post->region_encoded)
                    <div class="prod-info-item">
                        <div class="prod-info-name">{{__('ui.location')}}</div>
                        <div class="prod-info-text">{{$post->region_readable}}{{$post->town ? ", ".$post->town : ""}}</div>
                    </div>
                @endif
                @if ($post->cost)
                    <div class="prod-info-item">
                        <div class="prod-info-name">{{__('ui.cost')}}</div>
                        <div class="prod-info-text">{{$post->cost_readable}}</div>
                    </div>
                @endif
                <div class="prod-info-item">
                    <div class="prod-info-name">{{__('ui.postCreated')}}</div>
                    <div class="prod-info-text">{{$post->created_at_readable}}</div>
                </div>
            </div>
        </div>
    </div>
    @if ($authorPosts->isNotEmpty())
        <div class="horizontal-posts author-posts">
            <div class="horizontal-posts-top">
                <h2>{{__('ui.otherAuthorPosts')}}</h2>
                <div class="prod-controls author-posts-controls">
                    <a href="" class="prod-arrow prod-prev"></a>
                    <div class="prod-current"></div>
                    <div class="prod-divider"></div>
                    <div class="prod-all"></div>
                    <a href="" class="prod-arrow prod-next"></a>
                </div>
            </div>
            <div class="horizontal-posts-slider author-posts-slider">
                <x-home-items :posts="$authorPosts"/>
                <div class="ad-col ad-col-more">
                    <a href="{{loc_url(route('search', ['author'=>$post->user->url_name]))}}" class="ad-more">{{__('ui.allAuthorPosts')}}</a>
                </div>
            </div>
        </div>
    @endif
    @if ($simPosts->isNotEmpty())
        <div class="horizontal-posts similar-posts">
            <div class="horizontal-posts-top">
                <h2>{{__('ui.similarPosts')}}</h2>
                <div class="prod-controls similar-posts-controls">
                    <a href="" class="prod-arrow prod-prev"></a>
                    <div class="prod-current"></div>
                    <div class="prod-divider"></div>
                    <div class="prod-all"></div>
                    <a href="" class="prod-arrow prod-next"></a>
                </div>
            </div>
            <div class="horizontal-posts-slider similar-posts-slider">
                <x-home-items :posts="$simPosts"/>
            </div>
        </div>
    @endif
@endsection

@section('modals')
    <div id="popup-contacts" class="popup">
        <div class="popup-title">{{__('ui.contactInfo')}}</div>
        <div class="popup-prod-info">
            <div class="prod-info-item contact-email">
                <div class="prod-info-name">{{__('ui.email')}}:</div>
                <div class="prod-info-text"></div>
            </div>
            <div class="prod-info-item contact-phone">
                <div class="prod-info-name">{{__('ui.phone')}}:</div>
                <div class="prod-info-text"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            //count views
            $.ajax({
                type: "POST",
                url: "{{route('post.viewed')}}",
                data: { "_token": "{{csrf_token()}}", "post_id": "{{$post->id}}" }
            });

            // user click add author to mailer btn
            $('.add-to-mailer').click(function(e) {
                e.preventDefault();
                var button = $(this);
                button.addClass('loading');
                $.ajax({
                    type: "GET",
                    url: "{{ route('mailer.create.by.author', $post->user_id) }}",
                    success: function(data) {
                        try {
                            data = JSON.parse(data);
                            if ( data.code == 200 ) {
                                showPopUpMassage(true, data.message);
                                button.text("{{ __('ui.mailerAuthorAlreadyAdded') }}");
                            } else {
                                showPopUpMassage(false, data.message);
                            }
                        } catch (error) {
                            showPopUpMassage(false, "{{ __('messages.error') }}");
                        }
                        button.removeClass('loading');
                    },
                    error: function() {
                        showPopUpMassage(false, "{{ __('messages.error') }}");
                        button.removeClass('loading');
                    }
                });
            });

            //hide/show translated/origin title/description
            $('.show-origin-text').click(function(e){
                e.preventDefault();
                $('.prod-about h1, .prod-about p').toggleClass('hidden');
            });

            //show modal contacts
            $('.show-contacts').click(function(){
                var button = $(this);
                button.addClass('loading');
                if ("{{auth()->user() && !auth()->user()->is_standart}}") {
                    $.fancybox.close();
                    showPopUpMassage(false, "{{ __('messages.requireStandart') }}");
                    return;
                }
                $.ajax({
                    type: "GET",
                    url: "{{ route('get.contacts', $post->id) }}",
                    success: function(data) {
                        data = JSON.parse(data);
                        if ( data ) {
                            fillUpContacts(data);
                        } else {
                            showPopUpMassage(false, "{{ __('messages.requireStandart') }}");
                            $.fancybox.close();
                        }
                        button.removeClass('loading');
                    },
                    error: function(xhr, status, error) {
                        xhr['status'] == 403
                            ? showPopUpMassage(false, "{{ __('messages.authError') }}")
                            : showPopUpMassage(false, "{{ __('messages.error') }}");
                        button.removeClass('loading');
                    }
                });
            });

            function fillUpContacts (contacts) {
                contacts['email']
                    ? $('.contact-email .prod-info-text').text(contacts['email'])
                    : $('.contact-email .prod-info-text').text("{{__('ui.notSpecified')}}");
                contacts['phone']
                    ? $('.contact-phone .prod-info-text').text(contacts['phone'])
                    : $('.contact-phone .prod-info-text').text("{{__('ui.notSpecified')}}");
            }
        });
    </script>
@endsection