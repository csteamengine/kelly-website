<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ appName() }}</title>
        <meta name="description" content="@yield('meta_description', appName())">
        <meta name="author" content="@yield('meta_author', 'Charlie Steenhagen')">
        @yield('meta')

        @if($active_theme->favicon() != null)
            <link rel="icon"
                  type="{{$active_theme->favicon()->mime_type}}"
                  href="{{$active_theme->favicon()->getUrl()}}">
        @endif

        @stack('before-styles')
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            @if(isset($active_theme) && $active_theme->background_image() != null)
                 body{
                     background-color: #{{$active_theme->background_image()->getCustomProperty('color')}} !important;
                 }
            @endif
        </style>
        <link rel="stylesheet" href="{{mix('css/frontend/home/home.css')}}"/>
        @stack('after-styles')
    </head>
    @if(isset($active_theme) && $active_theme->background_image() != null)
        <body data-image="{{$active_theme->background_image()->getUrl()}}" class="lazy-load">
    @else
        <body>
    @endif
        @include('includes.partials.read-only')
        @include('includes.partials.logged-in-as')
        @include('includes.partials.announcements')
        @include('frontend.includes.nav')
        @include('includes.partials.messages')

        <div id="app">
            <div class="content">

            </div><!--content-->
        </div><!--app-->

        @stack('before-scripts')
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/frontend.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>
