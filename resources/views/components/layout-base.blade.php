<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>@hasSection('seo_title') @yield('seo_title')  @else {{__('homepage.seo.title')}} @endif</title>
        <meta name="description" content="@hasSection('seo_description') @yield('seo_description') @else {{__('seo.homepage.description')}} @endif"/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Gloria+Hallelujah&family=Prompt:wght@400;600;800&display=swap" rel="stylesheet">
        @yield('additional-styles')

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        {{-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMvZwAYKN-X3Wd0JWdrPRnJTcfdSWyrY8"> --}}
        {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMvZwAYKN-X3Wd0JWdrPRnJTcfdSWyrY8"></script> --}}

    </head>
    <body @class(["antialiased", $class])>
        <div id="app">
            {{-- @include('includes.header') --}}
            
            {{$slot}}
            
            {{-- @include('includes.footer') --}}
        </div>
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </body>
</html>