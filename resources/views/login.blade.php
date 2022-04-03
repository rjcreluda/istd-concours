<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="/resources/plugins/images/favicon1.png">

    <title>Login</title>

    <!-- =========================================
    CSS PLUGINS
    ===========================================-->

    <!-- Bootstrap Core CSS -->
    <link href="/resources/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="/resources/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">



    <!-- Menu CSS -->
    <link href="/resources/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">

    <!-- animation CSS -->
    <link href="/resources/css/animate.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/resources/css/style.css" rel="stylesheet">



    <!-- Cropper css Plugins -->
    <link href="/resources/css/croppie.css" rel="stylesheet">


    <!-- =========================================
    JAVASCRIPT PLUGINS
    ===========================================-->

    <!-- jQuery -->
    <script src="/resources/plugins/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/resources/bootstrap/dist/js/tether.min.js"></script>

    <script src="/resources/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="/resources/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>

    <!-- Menu Plugin JavaScript -->
    <script src="/resources/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

    <!--slimscroll JavaScript -->
    <script src="/resources/js/jquery.slimscroll.js"></script>

    <!--Wave Effects -->
    <script src="/resources/js/waves.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/resources/js/custom.min.js"></script>


    <!-- jquery-ui -->
    <script src="/resources/js/jquery-ui.min.js"></script>

    <!-- Sweet-Alert  -->
    <script src="/resources/plugins/sweetalert2/sweetalert2.all.js"></script>


     <!-- Cropper Js Plugins -->
     <script src="/resources/plugins/cropperjs/croppie.js"></script>

</head>

<body class="fix-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <!-- End Preloader -->
    <section id="wrapper" class="login-register" >
        <div class="login-box" style="border-radius: 3px; box-shadow: 0 0 15px 1px rgb(0 0 0 / 10%)">
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginform" method="post" action="{{ route('login.check') }}">
                    @csrf
                    <h3 class="box-title m-b-20">Connexion</h3>

                    @include('partials.message')

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" name="login" placeholder="Nom d'utilisateur">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" name="password" placeholder="Mot de passe">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Connexion</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
</section>
</body>
</html>