{{ __('ui.mailerNotifGreetings') }}! 
{{ __('ui.mailerNotifHeader') }}.
{{ $post->title }}
{{ $post->description }}

{{__('ui.mailerNotifBody', ['reason' => $reason])}}:
{{$reasonValue}}.
{{__('ui.mailerNotifBody2')}} {{__('ui.settingUpMailer')}} ({{loc_url(route('mailer.index'))}}).
{{__('ui.mailerNotifBody3') }}: {{ loc_url(route('posts.show', ['post'=>$post->id])) }}.

{{__('ui.mailerNotifSlg')}}
{{ env('APP_NAME') }} ({{loc_url(route('home'))}})

© {{ env('COPY_RIGHT_YEAR') }} {{ env('APP_NAME') }}. {{__('ui.footerCopyright')}}