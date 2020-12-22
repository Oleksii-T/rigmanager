{{loc_url(route('home'))}}

{{__('mail.mailGreetings')}} {{$userName}},

@yield('content')

{{__('mail.mailSlg')}}

© {{ env('COPY_RIGHT_YEAR') }} {{ env('APP_NAME') }}. {{__('ui.footerCopyright')}}