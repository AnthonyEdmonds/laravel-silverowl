<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>
            @isset($pageTitle){{ $pageTitle }} - @endif
            {{ env('APP_NAME', 'SilverOwl') }}
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#0b0c0c" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}" />
    </head>

    <body>

    </body>
</html>
