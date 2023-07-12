<?php
$users = $general->getUserByCoach($_SESSION['id']);
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
            <?php require_once ('./templates/coach/nav.php'); ?>
            <?php require_once ('./templates/default/top.php'); ?>
        </div>
    </div>
    <div class="right_col" role="main">
        <div class="">
            <!--contenut-->
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        Training Tracking
                    </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                <small>Your Team member</small>
                            </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Settings 1</a>
                                        <a class="dropdown-item" href="#">Settings 2</a>
                                    </div>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>E-mail</th>
                                                <th>Date Of Birth</th>
                                                <th>Gender</th>
                                                <th></th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            <?php
                                            foreach($users as $row) {
                                                $date_binth = $row['date_binth'];
                                                //$date = date('Y-m-d');
                                                $datetime1 = new DateTime($date_binth); // Date dans le passé
                                                $datetime2 = new DateTime(date("Y-m-d"));   // Date du jour (2018-09-07 16:10:21)
                                                $interval = $datetime1->diff($datetime2); ?>
                                                <tr>
                                                    <td><?= $row['first_name'] ?> </td>
                                                    <td><?=$row['last_name'] ?></td>
                                                    <td><?=$row['email'] ?> </td>
                                                    <td><?= $row['date_binth'] ?></td>
                                                    <td><?= $row['gender'] ?></td>
                                                    <td><a href="?coach=affect&id_user=<?= $row['id'] ?>" class="btn btn-app">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a href="?coach=show-training&id_user=<?= $row['id'] ?>" class="btn btn-app">
                                                            <i class="fa fa-edit"></i> Show
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
