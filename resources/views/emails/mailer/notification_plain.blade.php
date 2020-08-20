{{ __('ui.mailerNotifGreetings') }}! 
{{ __('ui.mailerNotifHeader') }}.
{{ $post->title }}
{{ $post->description }}

{{__('ui.mailerNotifBody', ['reason' => $reason])}}:
{{$reasonValue}}.
{{__('ui.mailerNotifBody2')}} {{__('ui.settingUpMailer')}} ({{route('mailer.index')}}).
{{__('ui.mailerNotifBody3') }}: {{ route('posts.show', $post->id) }}.

{{__('ui.mailerNotifSlg')}}
{{ env('APP_NAME') }} ({{route('home')}})

© {{ env('COPY_RIGHT_YEAR') }} {{ env('APP_NAME') }}. {{__('ui.footerCopyright')}}