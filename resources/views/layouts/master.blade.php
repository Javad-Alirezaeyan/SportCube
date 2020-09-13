<!DOCTYPE html>
<html  lang="en" >

<head>
 @include("layouts.partials.head")
</head>

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
    .container{
        margin-bottom: 50px;
    }
</style>
<body class="bg-light">

    <div id="app" >
        @include("layouts.partials.nav")


            <main role="main" class="container">

                <div class="d-flex align-items-center p-3 my-3 text-white-50  rounded box-shadow" style="background-color: blueviolet">

                    <div class="lh-100">
                        <h4 class="mb-0 text-white lh-100">@yield('title')</h4>
                    </div>
                </div>
                    @yield('content')

            </main>


        <footer-component></footer-component>
    </div>



<script src="{{ asset('js/app.js') }}" ></script>
</body>
</html>