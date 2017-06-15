<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Mailing Controller</title>

    <!-- Styles -->
    <link href="{{ mix('css/all.css') }}" rel="stylesheet">

    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

    @yield('css')
    @stack('css')

    <script src="https://use.fontawesome.com/16eefa3c87.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <i class="fa fa-envelope-o fa-1x"></i> {{ env('APP_NAME', trans('menu.newsletter')) }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="@if(request()->is('subscriptions*')) active @endif"><a href="{{ route('subscriptions.index') }}">{{ trans('menu.subscriptions') }}</a></li>
                        <li class="@if(request()->is('lists*')) active @endif"><a href="{{ route('lists.index') }}">{{ trans('menu.lists') }}</a></li>
                        <li class="@if(request()->is('campaigns*')) active @endif"><a href="{{ route('campaigns.index') }}">{{ trans('menu.campaigns') }}</a></li>
                        <li class="@if(request()->is('templates*')) active @endif"><a href="{{ route('templates.index') }}">{{ trans('menu.templates') }}</a></li>
                        <li class="@if(request()->is('settings*')) active @endif"><a href="{{ route('settings.application') }}">{{ trans('menu.settings') }}</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (auth()->guest())
                            <li><a href="{{ url('/login') }}">{{ trans('menu.login') }}</a></li>
                            @if(env('APP_REGISTER') == true)
                                <li><a href="{{ url('/register') }}">{{ trans('menu.register') }}</a></li>
                            @endif
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ auth()->user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('account.general') }}">
                                            <i class="fa fa-gear" aria-hidden="true"></i> {{ trans('menu.account') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}" id="logout-btn">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> {{ trans('menu.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            {{--<notify message="Hello, I'm Nathan Geerinck and I'm testing Vue.js! I'ts awesome!"></notify>--}}
            @include('errors.validation_errors')
            @include('parts.success')
        </div>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    @yield('javascript')
    @stack('javascript')
</body>
</html>
