<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
    </head>
    <body>
        <div class="container">
            <h1>Feedback From rigmanager.com.ua User</h1>
            <h3>User info from submited form:</h3>
            <ul>
                <li>
                    <p>User Name: [{{$name}}]</p>
                </li>
                <li>
                    <p>Subject: [{{$userSubject}}]</p>
                </li>
                <li>
                    <p>User Email: [{{$email}}]</p>
                </li>
                <li>
                    <p>User Message: [{{$text}}]</p>
                </li>
            </ul>
            @if ($user)
                <h3>User info from profile:</h3>
                <ul>
                    <li>
                        <p>User ID: {{$user->id}}</p>
                    </li>
                    <li>
                        <p>User Name: {{$user->name}}</p>
                    </li>
                    <li>
                        <p>User Email: {{$user->email}}</p>
                    </li>
                    <li>
                        <p>User Created At: {{$user->created_at}}</p>
                    </li>
                    <li>
                        <p>User Activated At: {{$user->email_verified_at}}</p>
                    </li>
                </ul>
            @else
                <h3>User was NOT Authenticated</h3>
            @endif
            <p>-P</p>
        </div>
    </body>
</html>