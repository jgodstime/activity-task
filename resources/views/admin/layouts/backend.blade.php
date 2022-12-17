<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">


    <title>@yield('title') - Admin</title>

    @yield('css_before')

    <!-- FAVICONS ICON -->
     <!-- FAVICONS ICON -->
    {{-- <link rel="icon" href="/assets/images/icon.png" type="image/x-icon" /> --}}
    {{-- <link rel="shortcut icon" type="image/x-icon" href="/assets/images/icon.png" /> --}}

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
       .breadcrumb {
            justify-content: end !important;
            margin-right: 1rem !important;
        }

        p{
            line-height: 32px !important;
        }

        .mdi-dots-horizontal{
            font-size: 24px
        }
       .dropdown-toggle{
        color: unset;
       }


    </style>
</head>


@yield('css_after')

<body style="background-color:#f8fbff;">

    <div id="layout-wrapper" style="overflow-x:hidden;">
        <div class="row flex-nowrap">
            @include('admin.layouts.sideNav')
            <main class="col ps-md-2 pt-2">
            @include('admin.layouts.topNav')

                @yield('content')
            </main>

        </div>

        {{-- @include('mentor.layouts.footer') --}}

    </div>

    <script src="/assets/js/bootstrap.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/assets/js/toastr.min.js"></script>
    {{-- @include('mentor.layouts.flashMessage') --}}


    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>







    @yield('js_after')

    <script>
         var ckEditor;

        var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i]) .then( editor => {
                //  console.log( editor );
                ckEditor = editor;
                // editor.getData(); // -> '<p>Foo!</p>'
                // editor.updateElement('Good')
                } )
                .catch( error => {
                    console.error( error );
                } )
            }
    </script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

{{-- Control side bar --}}
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth  <= 842){
            var element = document.getElementById('sidebar');
            element.classList.remove('show');
        }

    </script>
    @include('admin.layouts.flashMessage')

</body>

</html>
