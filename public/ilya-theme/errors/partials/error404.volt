<!DOCTYPE html>

<html lang="en-us" class="no-js">

	<head>
		<meta charset="utf-8">
		<title>404 GURU Able - Premium Admin Template by Codedthemes</title>
		<meta name="description" content="Flat able 404 Error page design">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Codedthemes">

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ static_url('ilya-theme/errors/assets/img/favicon.ico') }}">
		<link rel="stylesheet" type="text/css" href="{{ static_url('ilya-theme/errors/assets/css/style.css') }}" />
	</head>

	<body class="flat">

        <!-- Canvas for particles animation -->
        <div id="particles-js"></div>

        <!-- Your logo on the top left -->
        <a href="#" class="logo-link" title="back home">

            <img src="{{ static_url('ilya-theme/errors/assets/img/logo.png') }}" class="logo" alt="Company's logo" />

        </a>

        <div class="content">

            <div class="content-box">

                <div class="big-content">

                    <!-- Main squares for the content logo in the background -->
                    <div class="list-square">
                        <span class="square"></span>
                        <span class="square"></span>
                        <span class="square"></span>
                    </div>

                    <!-- Main lines for the content logo in the background -->
                    <div class="list-line">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>

                    <!-- The animated searching tool -->
                    <i class="fa fa-search" aria-hidden="true"></i>

                    <!-- div clearing the float -->
                    <div class="clear"></div>

                </div>

                <!-- Your text -->
                <h1>Oops! Error 404 not found.</h1>

                <p>{{ message }}</p>

            </div>

        </div>
    <footer class="light">
        <ul>
            <li><a href="#">Support</a></li>
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        </ul>
    </footer>
        <script src="{{ static_url('ilya-theme/errors/assets/js/jquery.min.js') }}"></script>
        <script src="{{ static_url('ilya-theme/errors/assets/js/bootstrap.min.js') }}"></script>

        <!-- Particles plugin -->
        <script src="{{ static_url('ilya-theme/errors/assets/js/particles.js') }}"></script>

    </body>

</html>
