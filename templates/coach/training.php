<?php
$entrenement = $general->entrenementByCoeach($_SESSION['id']);
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
                       Training Modification
                    </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                <small>List Of Training</small>
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
                                <div class="col-sm-12" style="text-align: right">
                                    <a href="?coach=form-training" class="btn btn-primary" style="text-align: right">ADD</a>
                                </div>
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered"
                                               style="width:100%">
                                           
                                            <thead>
                                            <tr>
                                                <th>Swimmer Name</th>
                                                <th>Date of his training</th>
                                                <th>Time of his training</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach($entrenement as $row) { ?>
                                                <tr>
                                                    <td><?= $row['name'] ?> </td>
                                                    <td><?=$row ['date'] ?></td>
                                                    <td><?=$row ['duree'] ?></td>
                                                    <td><a href="?coach=form-training&id=<?= $row['id'] ?>" class="btn btn-app">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a href="?coach=get-training&id=<?= $row['id'] ?>" class="btn btn-app">
                                                            <i class="fa fa-edit"></i> Show
                                                        </a>
                                                    </td>
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
