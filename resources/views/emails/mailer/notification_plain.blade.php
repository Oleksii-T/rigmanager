{{ __('ui.mailerNotifGreetings') }}!
{{ __('ui.mailerNotifHeader') }}.

@foreach ($found_posts as $p)
    {{ $p['title'] }}

@endforeach

{{__('ui.mailerNotifBody2')}} {{__('ui.settingUpMailer')}} ({{loc_url(route('mailer.index'))}}).

{{__('ui.mailerNotifSlg')}}
{{ env('APP_NAME') }} ({{loc_url(route('home'))}})

© {{ env('COPY_RIGHT_YEAR') }} {{ env('APP_NAME') }}. {{__('ui.footerCopyright')}}