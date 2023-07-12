<?php
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Swim.io</title>

        <!-- Bootstrap -->
        <link href="./web/asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="./web/asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="./web/asset/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="./web/asset/vendors/animate.css/animate.min.css" rel="stylesheet">
        <link href="./web/asset/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="./web/asset/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <!-- Custom Theme Style -->
        <link href="./web/asset/build/css/custom.min.css" rel="stylesheet">
		<style>
		.login{
			background-repeat:no-repeat !important;
			background-size:cover !important;
			background-position:center !important;
			background-image:url(./web/asset/image/imagee.png);
		}
		.login_content{
			    background-color: #ffffffb8;
    padding: 10px 20px;
	border-radius: 22px;
}
		}
		</style>
    </head>

    <body class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form method="post" action="?api=authentication" role="form" enctype="multipart/form-data">
                            <h1>Login to swim.io</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" name="username" required/>
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" name="password" required/>
                            </div>
                            <div>
                                <Button type="submit" class="btn btn-default submit" href="index.html" style="background: #2bceea;">Log in</Button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <!--<p class="change_link">New to site?
                                    <a href="#signup" class="to_register"> Create Account </a>
                                </p>-->

                                <div class="clearfix"></div>
                                <br/>

                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="./web/asset/vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="./web/asset/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="./web/asset/vendors/moment/min/moment.min.js"></script>
        <script src="./web/asset/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-datetimepicker -->
        <script src="./web/asset/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <!-- Ion.RangeSlider -->
        <script src="./web/asset/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
        <!-- Bootstrap Colorpicker -->
        <script src="./web/asset/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <!-- jquery.inputmask -->
        <script src="./web/asset/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#myDatepicker').datetimepicker();
            });


            $('#myDatepicker2').datetimepicker({
                format: 'YYYY-MM-DD'
            });

        </script>
    </body>
</html>
