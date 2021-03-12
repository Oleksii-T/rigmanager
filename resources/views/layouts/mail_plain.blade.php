{{loc_url(route('home'))}}

{{__('mail.mailGreetings')}} {{$userName}},


@yield('content')


{{__('mail.contactBack') . ' ' . env('MAIL_TO_ADDRESS')}}

{{__('mail.mailSlg')}}

© {{date("Y"). ' ' . env('APP_NAME') . '. ' . __('ui.footerCopyright')}}