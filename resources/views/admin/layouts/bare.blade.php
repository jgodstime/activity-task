<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title') - Admin</title>

    @yield('css_before')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css" rel="stylesheet"
        type="text/css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />


    <link href="/assets/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/toastr.min.css">

    <link rel="stylesheet" href="/assets/css/admin.css">
    <style>

        .btn-blue {
            background: #092D85 !important;
            color: #FFFFFF !important;
            width: 155px;
            text-align: center;
            padding: 1rem 1rem;
            background: transparent;
            border-radius: 30px;
            /* width: auto; */
        }
        p{
            line-height: 32px !important;
        }
    </style>

</head>


@yield('css_after')

<body>

    <div id="layout-wrapper">
        <header>
            {{-- @include('mentor.layouts.topNav')
                @include('mentor.layouts.sideNav') --}}
        </header>

        <div class="container pt-4">
            @yield('content')
        </div>


        {{-- @include('mentor.layouts.footer') --}}


    </div>

       <script src="/assets/js/bootstrap.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/assets/js/toastr.min.js"></script>
    {{-- @include('mentor.layouts.flashMessage') --}}

    @yield('js_after')
    @include('admin.layouts.flashMessage')

</body>

</html>
