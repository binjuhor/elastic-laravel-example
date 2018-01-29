<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/img/favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script> window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?></script>
    <!-- Bootstrap core CSS     -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/login') }}"> Login</a></li>
                {{-- <li><a href="{{ url('/register') }}"> Register</a></li> --}}
                <li><a href="{{ url('/password/reset') }}">Forgot Your Password?</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="wrapper wrapper-full-page">
    @yield('content')
</div>

</body>
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <script src="/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.js"></script>
    <script src="/js/bootstrap-selectpicker.js"></script>
    <script src="/js/bootstrap-checkbox-radio-switch-tags.js"></script>
    <script src="/js/chartist.min.js"></script>
    <script src="/js/bootstrap-notify.js"></script>
    <script src="/js/sweetalert2.js"></script>
    <script src="/js/jquery-jvectormap.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOeGmyX-gl-BqGDrCvYd1qeEWstO9553Y"></script>
    <script src="/js/jquery.bootstrap.wizard.min.js"></script>
    <script src="/js/bootstrap-table.js"></script>
    <script src="/js/jquery.datatables.js"></script>
    <script src="/js/fullcalendar.min.js"></script>
    <script src="/js/light-bootstrap-dashboard.js"></script>
    <script src="/js/jquery.sharrre.js"></script>
    <script src="/js/demo.js"></script>
    <script type="text/javascript">
        $().ready(function(){
            lbd.checkFullPageBackgroundImage();
            setTimeout(function(){
                $('.card').removeClass('card-hidden');
            }, 500)
        });
    </script>
    @yield('extrajs')
</html>