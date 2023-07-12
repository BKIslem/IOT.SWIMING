<?php
$result = $general->getTriniByUser($_SESSION['id']);
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
            <?php require_once ('./templates/user/nav.php'); ?>
            <?php require_once ('./templates/default/top.php'); ?>
        </div>
    </div>
    <div class="right_col" role="main">
        <div class="">
            <!--contenut-->
            <div class="page-title">
                <div class="title_left">
                    <h3>
                        Training Result
                    </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                <small>Evaluation Board</small>
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
                                                <th>The measured Duration of Training</th>
                                                <th>Date and Time of Training</th>
                                                <th>lanes</th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            <?php
                                            foreach($result as $row) {?>
                                                <tr>
                                                    <td><?= $row['duree'] ?> </td>
                                                    <td><?= $row['date'] ?></td>
                                                    <td><?= $row['lanes'] ?> </td>
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
