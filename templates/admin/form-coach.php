<?php
$data = null;
if(isset($_GET['id']) && $_GET['id']){
    $data = $general->getCoach($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title></title>
</head>
<?php require_once ('./templates/default/head.php'); ?>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="main_container">
            <?php require_once ('./templates/admin/nav.php'); ?>
            <?php require_once ('./templates/default/top.php'); ?>
        </div>
    </div>
    <div class="right_col" role="main">
        <div class="">
            <!--contenut-->
                <div class="page-title">
                    <div class="title_left">
                        <h3>Form Elements</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Form Design <small>different form elements</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a class="dropdown-item" href="#">Settings 1</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <form class="form" method="post" action="?admin=actionCoach" role="form" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= (isset($data['id']))? $data['id']: '' ?>">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">User Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="uesernmae" name="uesernmae" required="required" class="form-control " data-parsley-id="5" value="<?= (isset($data['username']))? $data['username']: '' ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="first-name" name="first-name"  required="required" class="form-control " data-parsley-id="5" value="<?= (isset($data['first_name']))? $data['first_name']: '' ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Last Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="last-name" name="last-name" name="last-name" required="required" class="form-control" data-parsley-id="7" value="<?= (isset($data['last_name']))? $data['last_name']: '' ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">E-mail <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input id="email" class="form-control" type="email" name="email" data-parsley-id="9" value="<?= (isset($data['email']))? $data['email']: '' ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Password <?= (isset($data['password']))? '' : '<span class="required">*</span>' ?></label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input id="password" class="form-control" type="password" name="password" data-parsley-id="9" <?= (isset($data['password']))? '' : 'required' ?>>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Gender <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <div id="gender" class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-secondary active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input <?= (isset($data['gender']) && $data['gender']=="male")? 'checked' : '' ?> type="radio" name="gender" value="male" class="join-btn" data-parsley-multiple="gender" data-parsley-id="12"> &nbsp; Male &nbsp;
                                                </label>
                                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input <?= (isset($data['gender']) && $data['gender']=="female")? 'checked' : '' ?> type="radio" name="gender" value="female" class="join-btn" data-parsley-multiple="gender"> Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input value="<?= (isset($data['date_binth']))? $data['date_binth']: '' ?>" name="birthday" id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)" data-parsley-id="16">
                                            <script>
                                                function timeFunctionLong(input) {
                                                    setTimeout(function() {
                                                        input.type = 'text';
                                                    }, 60000);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <input type="hidden" name="role" value="2">
                                    <div class="item form-group">
                                        <div class="col-md-6 col-sm-6 offset-md-3" style="text-align: right">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <!--fin contenut-->
        </div>
    </div>
    <footer>
        <div class="pull-right">
        </div>
        <div class="clearfix"></div>
    </footer>
</div>
<?php require_once ('./templates/default/footer.php'); ?>
</body>
</html>
