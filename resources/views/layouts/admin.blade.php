<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
        <meta name="description" content="">
        <meta name="author" content="Vinod Kumar">
        <link rel="shortcut icon" href="/favicon.ico">

        {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        {{-- Fonts --}}
        @yield('template_linked_fonts')

        {{-- Styles --}}
        <link rel="icon" type="image/gif" href="images/LogoOrange.png" />
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/select.css">
        <link rel="stylesheet" href="/css/admin.css">
        <link rel="stylesheet" href="/fontawesome/css/fontawesome-all.css">
        <link rel="stylesheet" href="/css/ampleread.css">
        <link rel="stylesheet" href="/css/freecategory.css">
        <link rel="stylesheet" href="/css/owl.carousel.css">
        <link rel="stylesheet" href="/css/main.css">

        @yield('template_linked_css')

        <style type="text/css">
            @yield('template_fastload_css')

            @if (Auth::User() && (Auth::User()->profile) && (Auth::User()->profile->avatar_status == 0))
                .user-avatar-nav {
                    background: url({{ Gravatar::get(Auth::user()->email) }}) 50% 50% no-repeat;
                    background-size: auto 100%;
                }
            @endif

        </style>
        <script type="text/javascript" src="/js/jquery.min.js"></script>

        {{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

        @yield('head')
        @yield('angularjs')
    </head>
    <body>
        <div class="admin-container">

            @include('partials.adminnav')

            
            <div class="admin-right">

                @include('partials.form-status')

                @yield('content')

                <!-- @include('partials.footer'); -->
            </div>
        </div>
        {{-- Scripts --}}
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/popup.js"></script>
        <script type="text/javascript" src="/js/select.js"></script>
        <script type="text/javascript" src="/js/ampleread.js"></script>
        <script type="text/javascript" src="/js/owl.carousel.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
        <script type="text/javascript">
            function resizemenu(){
                var windowheight=window.innerHeight;
                $(".admin-container .admin-left").css("height",windowheight);
                var rightcontainerheight=$(".admin-container .admin-right").height();
                if(rightcontainerheight>windowheight){
                    rightcontainerheight=rightcontainerheight+40;
                    $(".admin-container .admin-left").css("height",rightcontainerheight);
                }
            }
            $(document).ready(function(){
                resizemenu();
                $("#userSorting,#subcription,#status").select2();
            });
            $( window ).resize(function() {
                resizemenu();
            });
            $(".admin-menu ul li").click(function(){
                $(".admin-menu ul li").removeClass("active");
                $(this).addClass("active");

            });
            
            function formatState (state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = "/flags";
                var $state = $(
                    '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
                );
                return $state;
            };

            $("#selectcountry").select2({
                templateResult: formatState
            });
        </script>

        @yield('footer_scripts')

    </body>
</html>
