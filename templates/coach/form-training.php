<?php
$nums = $general->allNumero();
$metres = $general->allMetre();
$nagetype = $general->allNagetype();
$id = null;
if(isset($_GET['id'])) $id=$_GET['id'];
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
                    <h3>Form Training</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add a new Training</h2>
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
                            <form class="form" method="post" action="?coach=action-training" role="form" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $id  ?>">
                                <input type="hidden" name="coach" value="<?= $_SESSION['id'] ?>">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" name="name" required="required" class="form-control" data-parsley-id="7" value="<?= (isset($data['name']))? $data['name']: '' ?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Date<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input value="<?= (isset($data['datet']))? $data['debut']: '' ?>" name="date" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)" data-parsley-id="16">
                                        <script>
                                            function timeFunctionLong(input) {
                                                setTimeout(function() {
                                                    input.type = 'text';
                                                }, 60000);
                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Time<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="time" name="time" required="required">
                                    </div>
                                </div>
                                <div class="nage-type">
                                    <div class="form-group item element-nage-type">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Type of Swim <span class="num">1</span> <span class="required">*</span></label>
                                        <div class="col-md-2 col-sm-2 ">
                                            <select required class="select2_single form-control" tabindex="-1" name="id_nagetype[]">
                                                <option></option>
                                                <?php foreach($nagetype as $val) {?>
                                                    <option value="<?= $val['id'] ?>"><?= $val['libelle'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-2 ">
                                            <select required class="select2_single form-control" tabindex="-1" name="id_num[]">
                                                <option></option>
                                                <?php foreach($nums  as $val) {?>
                                                    <option value="<?= $val['id'] ?>"><?= $val['numero'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-2 ">
                                            <select required class="select2_single form-control" tabindex="-1" name="id_metre[]">
                                                <option></option>
                                                <?php foreach($metres as $val) {?>
                                                    <option value="<?= $val['id'] ?>"><?= $val['metre'] ?></option>
                                                <?php } ?>
                                            </select>
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
        <div class="form-group item element-nage-type element-#n#">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Type of Swim  <span class="num">#n#</span> <span class="required">*</span></label>
            <div class="col-md-2 col-sm-2 ">
                <select required class="select2_single form-control" tabindex="-1" name="id_nagetype[]">
                    <option></option>
                    <?php foreach($nagetype as $val) {?>
                        <option value="<?= $val['id'] ?>"><?= $val['libelle'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <select required class="select2_single form-control" tabindex="-1" name="id_num[]">
                    <option></option>
                    <?php foreach($nums  as $val) {?>
                        <option value="<?= $val['id'] ?>"><?= $val['numero'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-2 ">
                <select required class="select2_single form-control" tabindex="-1" name="id_metre[]">
                    <option></option>
                    <?php foreach($metres as $val) {?>
                        <option value="<?= $val['id'] ?>"><?= $val['metre'] ?></option>
                    <?php } ?>
                </select>
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
