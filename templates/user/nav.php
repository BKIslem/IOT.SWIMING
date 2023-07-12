<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Swimo.io</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="images/img1.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php
                    if (!empty($_SESSION)) {
                        echo $_SESSION['last_name'] . ' ' . $_SESSION['first_name'];
                    }
                    ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
				<ul class="nav side-menu">
                    <li class=""><a href="?user=home"><i class="fa fa-home"></i> Home</span></a></li>
                </ul>
				<ul class="nav side-menu">
                    <li class=""><a href="?user=agenda"><i class="fa fa-home"></i> Agenda</span></a></li>
                </ul>
                <ul class="nav side-menu">
                    <li class=""><a href="?user=training"><i class="fa fa-home"></i> Training</span></a></li>
                </ul>
				<ul class="nav side-menu">
                    <li class=""><a href="?user=get-training"><i class="fa fa-home"></i>Your Training Result</span></a></li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="" href="login.html" data-original-title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>