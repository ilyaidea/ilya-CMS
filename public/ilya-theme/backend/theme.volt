<!DOCTYPE html>
<html lang="en">

<head>
    {#<title>{{ helper.title().append('Administrative Panel') }}{{ helper.title().get() }}</title>#}
    {{ get_title() }}
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    {{ helper.meta().get('description') }}
    {{ helper.meta().get('keywords') }}
    {{ helper.meta().get('author') }}
    {{ helper.meta().get('seo-manager') }}
    <!-- Favicon icon -->
    <link rel="icon" href="{{ url.path() }}favicon.ico" type="image/x-icon">

    {{ assets.outputCss() }}
    {#{{ assets.outputCss('css_src') }}#}

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ static_url('ilya-theme/backend/assets/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ static_url('ilya-theme/backend/assets/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ static_url('ilya-theme/backend/assets/icon/icofont/css/icofont.css') }}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{{ static_url('ilya-theme/backend/assets/pages/menu-search/css/component.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ static_url('ilya-theme/backend/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ static_url('ilya-theme/backend/assets/css/jquery.mCustomScrollbar.css') }}">

    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/jquery/js/jquery.min.js') }}"></script>
</head>
<body>
    <!-- Pre-loader start -->
    {#{{ partial('loader') }}#}

    {{ content() }}

    {#{{ assets.outputJs() }}#}


    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/popper.js/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/modernizr/js/modernizr.js') }}"></script>
    <!-- am chart -->
    <script src="{{ static_url('ilya-theme/backend/assets/pages/widget/amchart/amcharts.min.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/pages/widget/amchart/serial.min.js') }}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/chart.js/js/Chart.js') }}"></script>
    <!-- Todo js -->
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/pages/todo/todo.js') }}"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/i18next/js/i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/pages/dashboard/custom-dashboard.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/js/demo-12.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{ static_url('ilya-theme/backend/assets/js/script.min.js') }}"></script>
</body>
</html>