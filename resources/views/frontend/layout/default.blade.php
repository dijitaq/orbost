<!doctype html>
    <html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        @stack('page-meta-tags')

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">

        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&family=Roboto:wght@400;700&display=swap">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

        @stack('page-styles')

        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

        <!-- laravel csrf token -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        <!-- laravel csrf token -->
    </head>

    @stack('body-class')
        <header id="main-header" class="position-fixed">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="cell small-12 large-4 position-relative logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.svg') }}" class="logo-orbost"></a>

                        <div id="trigger-container" class="show-for-small hide-for-large">
                            <a data-toggle="off-canvas">
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>

                    <div class="cell large-8 text-right hide-for-small-only hide-for-medium-only">
                        @include('frontend.includes.navigation', ['class' => "main"])
                    </div>
                </div>
            </div>
        </header>

        <div class="off-canvas-wrapper">
            <div class="off-canvas position-right" id="off-canvas" data-off-canvas>
                @include('frontend.includes.navigation', ['class' => "off-canvas"])
            </div>

            <div class="off-canvas-content" data-off-canvas-content>
                @yield('content')
            </div>
        </div>

        <footer class="text-center">
            <div class="vertical-separator mt-96px mb-96px"></div>

            <h2>Follow us on:</h2>

            <ul class="navigation social-media">
                <li>
                    <a href="https://www.facebook.com/Orbost-District-Real-Estate-107914347672541" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>
            </ul>
        </footer>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>

        @stack('page-scripts')
    </body>
</html>