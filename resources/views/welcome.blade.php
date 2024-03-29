<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


        <title>API REST FULL M.P.</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                   @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        {{--<a href="{{ route('login') }}">Login</a>--}}

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <div class="tocify-wrapper">
                        <img src="image/baner.png"/>
                </div>
                    <div class="links">
                        <a style="background-color: #FF984C" class="btn btn-outline-secondary" href="http://api-dev.fiscalia.gob.bo/docs"><b>Documentación API</b></a>
                        <a style="background-color: #FF984C" class="btn btn-outline-secondary" href="http://dev4.fiscalia.gob.bo/login"><b>Web Fiscalía Triton</b></a>
                        <a style="background-color: #FF984C" class="btn btn-outline-secondary" href="https://www.fiscalia.gob.bo/"><b>Ministerio Público</b></a>
                        <a style="background-color: #FF984C" class="btn btn-outline-secondary" href="https://c-permanente.fiscalia.gob.bo/"><b>Capacitación E.F.E.</b></a>
                    </div>
            </div>
        </div>
    </body>
</html>
