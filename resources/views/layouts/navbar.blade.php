<!-- Top Navigation -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part"><a class="logo" href="acceuil"><b><img src="/resources/plugins/images/logo.png" alt="home" /></b><span class="hidden-xs"><strong>gestion</strong>concours</span></a></div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="/resources/plugins/images/users/default.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php /*echo $_SESSION["utilisateur"];*/ ?></b> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li><a href="#" onclick="document.querySelector('#logout').submit()"><i class="fa fa-power-off"></i> Deconexion</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <form action="{{ route('logout')}}" method="post" id="logout">@csrf</form>
    <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
</nav>
<!-- End Top Navigation -->