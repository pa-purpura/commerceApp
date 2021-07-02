<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravellal') }}</title>

    <!-- Scripts -->
    script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <script src="{{ asset('backend/js/app.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/pace.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('backend/css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ __('secondo_test') }}">
                    Secondo test
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                      @php $locale = session()->get('locale'); @endphp
                        @php echo ($locale); @endphp
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Language <span class="caret"></span>
                            </a>
                            @switch($locale)
                                @case('fr')
                                <img src="{{asset('img/fr.png')}}" width="30px" height="20x"> Francais
                                @break
                                @case('it')
                                <img src="{{asset('img/it.png')}}" width="30px" height="20x"> Italiano
                                @break
                                @case('de')
                                <img src="{{asset('img/de.png')}}" width="30px" height="20x"> German
                                @break
                                @default
                                <img src="{{asset('img/us.png')}}" width="30px" height="20x"> English
                            @endswitch
                            {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
                            <div class="" aria-labelledby="">
                                <a class="dropdown-item" href="lang/en"><img src="{{asset('img/us.png')}}" width="30px" height="20x"> English</a>
                                <a class="dropdown-item" href="lang/fr"><img src="{{asset('img/fr.png')}}" width="30px" height="20x"> French</a>
                                <a class="dropdown-item" href="lang/it"><img src="{{asset('img/it.png')}}" width="30px" height="20x"> Italiano</a>
                                <a class="dropdown-item" href="lang/de"><img src="{{asset('img/de.png')}}" width="30px" height="20x"> German</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
