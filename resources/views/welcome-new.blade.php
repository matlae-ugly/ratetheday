<html>
    <head>
        <title>RateTheDay</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="welcome-body">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Sing in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Sign up</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="header">
            <span>RateTheDay</span>
            <h5>Simple web application for day managment</h5>
        </div>
        <figure class="quote">
            <blockquote>
                <i>May you live all the days of your life</i>
            </blockquote>
            <figcaption>
                &mdash; Jonathan Swift
            </figcaption>
        </figure>
        <div class="footer">
            © RateTheDay by Matlae.
        </div>
    </body>
</html>
