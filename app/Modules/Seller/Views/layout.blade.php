<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') | CORK - Multipurpose Bootstrap Dashboard Template </title>
    <link rel="icon" type="image/x-icon" href="/public/upload/images/logo/favicon.ico"/>
    <link href="/public/sites/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="/public/sites/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/public/sites/css/bootstrapv4.6/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/public/sites/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/public/sites/css/structure.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="/public/sites/css/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/public/sites/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="/public/sites/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body>
    @include('Seller::inc.header')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('Seller::inc.sidebar')
        @show

        @yield('content')

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/public/sites/js/libs/jquery-3.1.1.min.js"></script>
    <script src="/public/sites/js/popper.min.js"></script>
    <script src="/public/sites/js/bootstrapv4.6/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="/public/sites/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="/public/sites/js/apex/apexcharts.min.js"></script>
    <script src="/public/sites/js/dashboard/dash_1.js"></script>
    <script src="/public/sites/js/dashboard/dash_2.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>
</html>