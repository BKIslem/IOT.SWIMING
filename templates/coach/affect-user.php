<?php
$bloc = $general->allBloc();
$user = $general->getUser($_GET['id_user']);
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
                    <h3>The date of his training</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2> Add and Modify the date of his training</h2>
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
                            <form class="form" method="post" action="?coach=affectation" role="form" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= (isset($data['id']))? $data['id']: '' ?>">
                                <input type="hidden" name="coach" value="<?= $_SESSION['id'] ?>">
                                <input type="hidden" name="id_user" value="<?=$_GET['id_user']?>">
                                <div class="nage-type">
                                    <div class="form-group item element-nage-type">

                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Lanes:Date:Swimming Type <span class="num">1</span> <span class="required">*</span></label>
                                        <div class="col-md-2 col-sm-2 ">
                                            <select required class="select2_single form-control" tabindex="-1" name="bloc[]">
                                                <option></option>
                                                <?php  foreach($bloc as $row) { ?>
                                                    <option value="<?= $row['id'] ?>" <?= (isset($data['bloc']) && $data['bloc'] == $row['id'] )? 'selected' : '' ?>> <?= $row['label'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-2 ">
                                            <select required class="select2_single form-control" tabindex="-1" name="jour[]">
                                                <option></option>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                                <option value="Saturday">Saturday</option>
                                                <option value="Sunday">Sunday</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-2 ">
                                            <input placeholder="Time Strat" class="form-control" type="time" name="time_strat[]" required="required">
                                        </div>
                                        <div class="col-md-2 col-sm-2 ">
                                            <input placeholder="Time End" placeholder="" class="form-control" type="time" name="time_end[]" required="required">
                                        </div>
                                        <div class="col-md-2 col-sm-2 ">
                                            <button type="button" class="btn btn-success ajouter-element">+</button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="role" value="1">
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
    <div class="hidden-element" style="display: none">
        <div class="form-group item element-nage-type">

            <label class="col-form-label col-md-3 col-sm-3 label-align">Jour <span class="num">1</span> <span class="required">*</span></label>
            <div class="col-md-2 col-sm-2 ">
                <select required class="select2_single form-control" tabindex="-1" name="bloc[]">
                    <option></option>
                    <?php  foreach($bloc as $row) { ?>
                        <option value="<?= $row['id'] ?>" <?= (isset($data['bloc']) && $data['bloc'] == $row['id'] )? 'selected' : '' ?>> <?= $row['label'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <select required class="select2_single form-control" tabindex="-1" name="jour[]">
                    <option></option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <input placeholder="Time Strat" class="form-control" type="time" name="time_strat[]" required="required">
            </div>
            <div class="col-md-2 col-sm-2 ">
                <input placeholder="Time End" placeholder="" class="form-control" type="time" name="time_end[]" required="required">
            </div>
            <div class="col-md-2 col-sm-2 ">
                <button type="button" class="btn btn-danger supprimer-element">-</button>
            </div>
        </div>
    </div>
    <footer>
        <div class="pull-right">
        </div>
        <div class="clearfix"></div>
    </footer>
</div>
<?php require_once ('./templates/default/footer.php'); ?>
<script>
    $(document).on("click", '.supprimer-element', function () {
        $(this).parent().parent().remove();
        $(".nage-type .element-nage-type").each(function (index){
            $(this).find(".num").text(index + 1)
        })
    })
    $(document).on("click", '.ajouter-element', function () {
        $html =$(".hidden-element").html();
        $(".nage-type").append($html);
        $(".nage-type .element-nage-type").each(function (index){
            $(this).find(".num").text(index + 1)
        })
    })
</script>
</body>
</html>
