<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config("app.name", "Laravel") }}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>

<body>
    <v-app id="app">
    @include('partials.adminSidebar')
    @include('partials.adminTopNav')
        <v-content>
            <v-container fluid>
                @yield('content')
            </v-container>
        </v-content>
    </v-app>
    @include('partials.adminScripts')
</body>

</html>
