<?php
require 'controller/ManagerController.php';
require 'PHPExcel/Classes/PHPExcel.php';
require 'PHPExcel/Classes/PHPExcel/IOFactory.php';
$manager = new ManagerController();
$general = new GeneralController();

if(isset($_GET['api'])){
    if($_GET['api'] == 'authentication'){
        $general->authentication();
    }
    if($_GET['api'] == 'getTrinigJeson'){
        $general->getTrinigJeson();
		exit;
    }
}

if(!isset($_SESSION['id'])){
    require ROOT . '/login.php';
   
}else{
    if (isset($_GET['admin'])) {
        if($_GET['admin'] == 'home'){
            require ROOT . '/templates/admin/index.php';
        }
        if($_GET['admin'] == 'user'){
            require ROOT . '/templates/admin/liste-user.php';
        }
        if($_GET['admin'] == 'coach'){
            require ROOT . '/templates/admin/liste-coach.php';
        }
        if($_GET['admin'] == 'formCoach'){
            require ROOT . '/templates/admin/form-coach.php';
        }
        if($_GET['admin'] == 'formUser'){
            require ROOT . '/templates/admin/form-user.php';
        }
        if($_GET['admin'] == 'userCoach'){
            require ROOT . '/templates/admin/form-coach.php';
        }
        if($_GET['admin'] == 'actionCoach'){
            $general->actionCoach();
        }
        if($_GET['admin'] == 'actionUser'){
            $general->actionUser();
        }
    }elseif (isset($_GET['coach'])) {
        if($_GET['coach'] == 'home'){
            require ROOT . '/templates/coach/index.php';
        }
        if($_GET['coach'] == 'user'){
            require ROOT . '/templates/coach/liste-user.php';
        }
        if($_GET['coach'] == 'form-training'){
            require ROOT . '/templates/coach/form-training.php';
        }
        if($_GET['coach'] == 'show-training'){
            require ROOT . '/templates/coach/show-training.php';
        }
        if($_GET['coach'] == 'action-training'){
            $general->actionTraining();
        }
        if($_GET['coach'] == 'training'){
            require ROOT . '/templates/coach/training.php';
        }
		if($_GET['coach'] == 'get-training'){
            require ROOT . '/templates/coach/get-training.php';
        }
        if($_GET['coach'] == 'affect'){
            require ROOT . '/templates/coach/affect-user.php';
        }
        if($_GET['coach'] == 'affectation'){
            $general->affectation();
        }
    }elseif (isset($_GET['user'])) {
        if($_GET['user'] == 'home'){
            require ROOT . '/templates/user/index.php';
        }
        if($_GET['user'] == 'training'){
            require ROOT . '/templates/user/training.php';
        }
		if($_GET['user'] == 'show-training'){
            require ROOT . '/templates/user/show-training.php';
        }
		if($_GET['user'] == 'get-training'){
            require ROOT . '/templates/user/get-training.php';
        }
		if($_GET['user'] == 'agenda'){
            require ROOT . '/templates/user/agenda.php';
        }
    }else{
        $general->redirct();
    }
}
if(isset($_GET['login'])){

    if ($_GET['login'] == 'login') {
        require ROOT . '/login.php';
    }
    if($_GET['login'] == 'logout'){
        $general->logout();
    }
}

?>