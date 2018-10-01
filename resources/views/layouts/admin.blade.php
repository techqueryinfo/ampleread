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
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/popup.css">
        <link rel="stylesheet" href="/css/select.css">
        <link rel="stylesheet" href="/css/admin.css">
        <link rel="stylesheet" href="/fontawesome/css/fontawesome-all.css">
        <link rel="stylesheet" href="/css/ampleread.css">
        <link rel="stylesheet" href="/css/freecategory.css">
        <link rel="stylesheet" href="/css/owl.carousel.css">
        <link rel="stylesheet" href="/css/admin-home.css">
        <link rel="stylesheet" href="/css/admin-stat.css">
        <link rel="stylesheet" href="/css/admin-freeebbok.css">
        <link rel="stylesheet" href="/css/export.css">
        <link rel="stylesheet" href="/css/book-category.css">
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
                @if(Session::has('flash_message'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{Session::get('flash_message')}}.
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
        {{-- Scripts --}}
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/popup.js"></script>
        <script type="text/javascript" src="/js/select.js"></script>
        <script type="text/javascript" src="/js/ampleread.js"></script>
        <script type="text/javascript" src="/js/owl.carousel.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
        <script type="text/javascript" src="/js/amcharts.js"></script>
        <script type="text/javascript" src="/js/export.js"></script>
        <script type="text/javascript" src="/js/light.js"></script>
        <script type="text/javascript" src="/js/pie.js"></script>
        <script type="text/javascript" src="/js/admin.js"></script>
        <script src="https://www.amcharts.com/lib/3/xy.js"></script>
        <script src="https://www.amcharts.com/lib/3/serial.js"></script>
        <script src="https://www.amcharts.com/lib/3/ammap.js" type="text/javascript"></script>
        <script src="https://www.amcharts.com/lib/3/maps/js/worldHigh.js" type="text/javascript"></script>
        <script src="https://www.amcharts.com/lib/3/themes/dark.js" type="text/javascript"></script>
        <script type="text/javascript">
            function resizemenu(){
                var windowheight=window.innerHeight;
                $(".admin-container .admin-left").css("height",windowheight);
                var rightcontainerheight=$(".admin-container .admin-right").height();
                $(".admin-container .admin-left .logout").css("top",windowheight-50);
                if(rightcontainerheight>windowheight){
                    rightcontainerheight=rightcontainerheight+40;
                    $(".admin-container .admin-left").css("height",rightcontainerheight);
                    $(".admin-container .admin-left .logout").css("top",rightcontainerheight-50);
                }
            }
            $(document).ready(function(){
                resizemenu();
            });
            $( window ).resize(function() {
                resizemenu();
            });
            $(".admin-menu ul li").click(function(){
                $(".admin-menu ul li").removeClass("active");
                $(this).addClass("active");
            });
            $("#userSorting,#subcription,#status,#ebooktype,#ebookcategory,#ebookauthor").select2();
            function formatState (state) {
                if (!state.id) {
                    return state.text;
                }
                console.log('country', state.element.id, state, state.element.attributes);
                var baseUrl = "../flags";
                var $state = $(
                    '<span><img src="' + baseUrl + '/' + state.element.id.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
                    );
                return $state;
            };
            $("#selectcountry").select2({
                templateResult: formatState
            });
        </script>
        <script>
            var chart = AmCharts.makeChart( "chartdiv", {
                "type": "pie",
                "theme": "light",
                "dataProvider": [ {
                    "title": "New",
                    "value": 4852
                }, {
                    "title": "Returning",
                    "value": 9899
                } ],
                "titleField": "title",
                "valueField": "value",
                "labelRadius": 5,

                "radius": "42%",
                "innerRadius": "60%",
                "labelText": "[[title]]",
                "export": {
                    "enabled": true
                }
            } );
        </script>
        <script type="text/javascript">
            var map = AmCharts.makeChart("mapchart",{
                type: "map",
                theme: "dark",
                projection: "mercator",
                panEventsEnabled : true,
                backgroundColor : "transparent",
                backgroundAlpha : 1,
                zoomControl: {
                    zoomControlEnabled : true
                },
                dataProvider : {
                    map : "worldHigh",
                    getAreasFromMap : true,
                    areas :
                    []
                },
                areasSettings : {
                    autoZoom : true,
                    color : "#78c0e5",
                    colorSolid : "#84ADE9",
                    selectedColor : "#84ADE9",
                    outlineColor : "#666666",
                    rollOverColor : "#9EC2F7",
                    rollOverOutlineColor : "#000000"
                }
            });
        </script>
<script>
    var chart = AmCharts.makeChart("xycharts", {
        "type": "xy",
        "theme": "light",
        "marginRight": 80,
        "dataDateFormat": "YYYY-MM-DD",
        "startDuration": 1.5,
        "trendLines": [],
        "balloon": {
            "adjustBorderColor": false,
            "shadowAlpha": 0,
            "fixedPosition": true
        },
        "graphs": [{
            "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>y:<b>[[y]]</b><br>value:<b>[[value]]</b></div>",
            "bullet": "diamond",
            "maxBulletSize": 25,
            "lineAlpha": 0.8,
            "lineThickness": 2,
            "lineColor": "#b0de09",
            "fillAlphas": 0,
            "xField": "date",
            "yField": "ay",
            "valueField": "aValue"
        }, {
            "balloonText": "<div style='margin:5px;'><b>[[x]]</b><br>y:<b>[[y]]</b><br>value:<b>[[value]]</b></div>",
            "bullet": "round",
            "maxBulletSize": 25,
            "lineAlpha": 0.8,
            "lineThickness": 2,
            "lineColor": "#fcd202",
            "fillAlphas": 0,
            "xField": "date",
            "yField": "by",
            "valueField": "bValue"
        }],
        "valueAxes": [{
            "id": "ValueAxis-1",
            "axisAlpha": 0
        }, {
            "id": "ValueAxis-2",
            "axisAlpha": 0,
            "position": "bottom"
        }],
        "allLabels": [],
        "titles": [],
        "dataProvider": [{
            "date": 1,
            "ay": 6.5,
            "by": 2.2,
            "aValue": 15,
            "bValue": 10
        }, {
            "date": 2,
            "ay": 12.3,
            "by": 4.9,
            "aValue": 8,
            "bValue": 3
        }, {
            "date": 3,
            "ay": 12.3,
            "by": 5.1,
            "aValue": 16,
            "bValue": 4
        }, {
            "date": 5,
            "ay": 2.9,
            "aValue": 9
        }, {
            "date": 7,
            "by": 8.3,
            "bValue": 13
        }, {
            "date": 10,
            "ay": 2.8,
            "by": 13.3,
            "aValue": 9,
            "bValue": 13
        }, {
            "date": 12,
            "ay": 3.5,
            "by": 6.1,
            "aValue": 5,
            "bValue": 2
        }, {
            "date": 13,
            "ay": 5.1,
            "aValue": 10
        }, {
            "date": 15,
            "ay": 6.7,
            "by": 10.5,
            "aValue": 3,
            "bValue": 10
        }, {
            "date": 16,
            "ay": 8,
            "by": 12.3,
            "aValue": 5,
            "bValue": 13
        }, {
            "date": 20,
            "by": 4.5,
            "bValue": 11
        }, {
            "date": 22,
            "ay": 9.7,
            "by": 15,
            "aValue": 15,
            "bValue": 10
        }, {
            "date": 23,
            "ay": 10.4,
            "by": 10.8,
            "aValue": 1,
            "bValue": 11
        }, {
            "date": 24,
            "ay": 1.7,
            "by": 19,
            "aValue": 12,
            "bValue": 3
        }],
        "chartCursor": {
            "pan": true,
            "cursorAlpha": 0,
            "valueLineAlpha": 0
        }
    });
</script>
<script>
    var chart = AmCharts.makeChart("traficstat", {
        "type": "serial",
        "theme": "light",
        "marginRight": 70,
        "dataProvider": [{
            "country": "Mail",
            "visits": 3025,
            "color": "#8ea1b2"
        }, {
            "country": "Paid search campaign",
            "visits": 1882,
            "color": "#8ea1b2"
        }, {
            "country": "Social media",
            "visits": 1809,
            "color": "#8ea1b2"
        }, {
            "country": "Referrals",
            "visits": 1322,
            "color": "#8ea1b2"
        }, {
            "country": "Display ads",
            "visits": 1122,
            "color": "#8ea1b2"
        }, {
            "country": "Direct search",
            "visits": 1114,
            "color": "#8ea1b2"
        }, ],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": ""
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
        },
    });
</script>
    @yield('footer_scripts')
    </body>
</html>