<?php

use PHPExcel\Classes\PHPExcel;
use PHPExcel\Classes\PHPExcel\IOFactory;

class GeneralController
{
    //General Config id
    CONST DIR_PATH = "./web/upload/";

    public function getConnection(){
        return DBManager::getInstance()->getConnection();
    }

    function url(){
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
    }

    function DeleteAuth() {
        if(isset($_SESSION['id']) && $_SESSION['id']) {
            unset($_SESSION["first_name"], $_SESSION["last_name"], $_SESSION["role"], $_SESSION["id"]);
        }
    }

    public function logout(){
        $this->DeleteAuth();
        header("Location: index.php?login=login");
    }
    public function redirct(){
        try {
            if((isset($_SESSION['role']) && $_SESSION['role']) && (isset($_SESSION['id']) && $_SESSION['id'])){
                if($_SESSION['role'] == 3){
                    header("Location: index.php?admin=home");
                }elseif($_SESSION['role'] == 2){
                    header("Location: index.php?coach=home");
                }else{
                    header("Location: index.php?user=home");
                }
            }else{
                   header("Location: ?login=login");
			}
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function authentication ()
    {
        try {
            $this->DeleteAuth();
            $res = 0;
            $sql = "select * from user where LOWER(username) LIKE '".strtolower($_POST['username'])."' and password LIKE '".md5($_POST['password'])."'  and deleted = 0 ";

            $user = DBManager::getInstance()->row($sql);
            if(!empty($user)){
                $_SESSION['first_name']= $user['first_name'];
                $_SESSION['last_name']=$user['last_name'];
                $_SESSION['role']=$user['role'];
                $_SESSION['id']=$user['id'];
                $res = $user['role'];
                if($res == 3){
                    header("Location: ?admin=home");
                }elseif($res == 2){
                    header("Location: ?coach=home");
                }else{
                    header("Location: ?user=home");
                }
            }else {
                header("Location: index.php?login=login");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function allCoach ()
    {
        try {
            $sql = "select * from user where role = 2  and deleted = 0";
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getCoach($id)
    {
        try {
            $sql = "select * from user where role = 2  and deleted = 0 and id = ".$id;
            $res = DBManager::getInstance()->row($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function actionCoach()
    {
        try {
            $rest = false;
            $id = $_POST['id'];
            $role = $_POST['role'];
            $uesernme = $_POST['uesernmae'];
            $firstname = $_POST['first-name'];
            $lastname = trim($_POST['last-name']);
            $email = trim($_POST['email']);
            $birthday = $_POST['birthday'];
            $gender = $_POST['gender'];
            $password = md5($_POST['password']);
            $choeach = array();
            if(isset($id) && $id){
                $choeach = $this->getCoach($id);
                if($choeach ) {
                    $choeach['username'] = $uesernme;
                    $choeach['first_name'] = $firstname;
                    $choeach['last_name'] = $lastname;
                    $choeach['date_binth'] = $birthday;
                    $choeach['email'] = $email;
                    $choeach['gender'] = $gender;
                    $where = " id = ." + $id;
                    $rest = DBManager::getInstance()->update('user', $choeach, $where);
                }
            }else{
                $choeach['username'] = $uesernme;
                $choeach['first_name'] = $firstname;
                $choeach['last_name'] = $lastname;
                $choeach['date_binth'] = $birthday;
                $choeach['email'] = $email;
                $choeach['gender'] = $gender;
                $choeach['role'] = $role;
                $choeach['password'] = $password;
                $rest = DBManager::getInstance()->insert('user', $choeach);
            }
            if ($rest) {
                $_SESSION['message'] = 'Données enregistrées avec succès';
                $_SESSION['type'] = 'success';
                header("Location: index.php?admin=coach");
            } else {
                $_SESSION['message'] = 'erreur: l\'enregistrement n\'a pas pu être inséré';
                $_SESSION['type'] = 'danger';
                header("Location: index.php?admin=formCoach");
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deletedCoach ($id)
    {
        try {
            $coach = $this->getCoach($id);
            if($coach) {
                $coach['deleted'] = 1;
                $where = " id = ." + $id;
                $rest = DBManager::getInstance()->update('user', $coach, $where);
                if ($rest) {
                    $_SESSION['message'] = 'Données supprimer avec succès';
                    $_SESSION['type'] = 'success';
                } else {
                    $_SESSION['message'] = 'erreur: erreur supprimer';
                    $_SESSION['type'] = 'danger';
                }
            }
            header("Location: index.php?admin=coach");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function allUser ()
    {
        try {
            $sql = "select u.*, u1.first_name as first_name_coach, u1.last_name as last_name_coach  from user as u left join user u1 on u1.id = u.id_coach where u.role = 1 and u.deleted = 0";
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUser ($id)
    {
        try {
            $sql = "select * from user where role = 1  and deleted = 0 and id = ".$id;
            $res = DBManager::getInstance()->row($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deletedUser ($id)
    {
        try {
            $user = $this->getUser($id);
            if($user) {
                $user['deleted'] = 1;
                $where = " id = ." + $id;
                $rest = DBManager::getInstance()->update('user', $user, $where);
                if ($rest) {
                    $_SESSION['message'] = 'Données supprimer avec succès';
                    $_SESSION['type'] = 'success';
                } else {
                    $_SESSION['message'] = 'erreur: erreur supprimer';
                    $_SESSION['type'] = 'danger';
                }
            }
            header("Location: index.php?admin=user");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function actionUser()
    {
        try {
            $rest = false;
            $id = $_POST['id'];
            $role = $_POST['role'];
            $uesernme = $_POST['uesernmae'];
            $firstname = $_POST['first-name'];
            $lastname = trim($_POST['last-name']);
            $email = trim($_POST['email']);
            $birthday = $_POST['birthday'];
            $gender = $_POST['gender'];
            $password = md5($_POST['password']);
            $coach = $_POST['coach'];
            $user = array();
                if (isset($id) && $id) {
                    $user = $this->getUser($id);
                    if ($user) {
                        $user['username'] = $uesernme;
                        $user['first_name'] = $firstname;
                        $user['last_name'] = $lastname;
                        $user['date_binth'] = $birthday;
                        $user['email'] = $email;
                        $user['gender'] = $gender;
                        $user['id_coach'] = $coach;
                        $where = " id = ." + $id;
                        $rest = DBManager::getInstance()->update('user', $user, $where);
                    }
                } else {
                    $user['username'] = $uesernme;
                    $user['first_name'] = $firstname;
                    $user['last_name'] = $lastname;
                    $user['date_binth'] = $birthday;
                    $user['email'] = $email;
                    $user['gender'] = $gender;
                    $user['role'] = $role;
                    $user['password'] = $password;
                    $user['id_coach'] = $coach;
                    $rest = DBManager::getInstance()->insert('user', $user);
                }
                if ($rest) {
                    $_SESSION['message'] = 'Données enregistrées avec succès';
                    $_SESSION['type'] = 'success';
                    header("Location: index.php?admin=user");
                } else {
                    $_SESSION['message'] = 'erreur: l\'enregistrement n\'a pas pu être inséré';
                    $_SESSION['type'] = 'danger';
                    header("Location: index.php?admin=formUser");
                }


        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUserByCoach ($coach)
    {
        try {
            $sql = "select * from user where role = 1  and deleted = 0 and id_coach = ".$coach;
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function allNumero ()
    {
        try {
            $sql = "select * from numero";
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function allMetre ()
    {
        try {
            $sql = "select * from metre";
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function allBloc ()
    {
        try {
            $sql = "select * from bloc";
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function allNagetype ()
    {
        try {
            $sql = "select * from nagetype";
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function entrenementByUser($id)
    {
        try {
            $sql = "select * from entrenement where id_user = " .$id;
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function entrenementByCoeach($id)
    {
        try {
            $sql = "select * from entrenement where id_coach = " . $id;
			
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getEntrenement($id)
    {
        try {
            $sql = "select * from entrenement where id = " . $id;
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function actionTraining()
    {
        try {
            $name = $_POST['name'];
            $date = $_POST['date'];
            $duree = $_POST['time'];
            $id_nagetype = $_POST['id_nagetype'];
            $id_num = $_POST['id_num'];
            $id_metre = $_POST['id_metre'];
            $coach = $_POST['coach'];
			$id = $_POST['id'];
            if (isset($id) && $id) {
                $entrenement = $this->getEntrenement($id);
                if ($entrenement) {
                    $entrenement['name'] = $name;
                    $entrenement['date'] = $date;
                    $entrenement['duree'] = $duree;
                    $where = " id = ." . $id;
                    $delete = DBManager::getInstance()->delete('entrenement', $where, $limit = 100);
                    $rest = DBManager::getInstance()->update('entrenement', $entrenement, $where);
                    foreach($id_nagetype as $k=> $val){
                        $data = array('id_entrenement'=> $id, 'id_nagetype'=>$id_nagetype[$k], 'id_num'=>$id_num[$k], 'id_metre'=>$id_metre[$k]);
                        $rest = DBManager::getInstance()->insert('entrenement_nagetype', $data);
                    }
                }
            } else {
                $entrenemen = array('name'=>$name, 'date'=>$date,'duree'=> $duree, 'id_coach'=>$coach);
                $rest = DBManager::getInstance()->insert('entrenement', $entrenemen);
                foreach($id_nagetype as $k=> $val){
                    $id = DBManager::getInstance()->lastInsertId();
                    $data = array('id_entrenement'=> $id, 'id_nagetype'=>$id_nagetype[$k], 'id_num'=>$id_num[$k], 'id_metre'=>$id_metre[$k]);
                    $rest = DBManager::getInstance()->insert('entrenement_nagetype', $data);
                }
            }
            if ($rest) {
                $_SESSION['message'] = 'Données enregistrées avec succès';
                $_SESSION['type'] = 'success';
                header("Location: index.php?coach=training");
            } else {
                $_SESSION['message'] = 'erreur: l\'enregistrement n\'a pas pu être inséré';
                $_SESSION['type'] = 'danger';
                header("Location: index.php?coach=form-training");
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function affectation()
    {
        try {
            $rest = false;
            $id= $_POST['id_user'];
            if($id){
                $where = " id_user = " .$id;
                $delete = DBManager::getInstance()->delete('agend', $where, $limit = 100);
                $jour = $_POST['jour'];
                $time_start = $_POST['time_strat'];
                $time_end = $_POST['time_end'];
                $id_bloc = $_POST['bloc'];
                foreach($jour as $k=>$val){
                    $sql = "select * from agend where LOWER(jour) = '".strtolower($jour[$k])."' and id_bloc = ".$id_bloc[$k] ." and ( ('".$time_start[$k]."' >= time_strat AND '".$time_start[$k]."' <= time_end) or ('".$time_end[$k] ."' >= time_strat AND '".$time_end[$k] ."' <=time_end) )";
                   $test = DBManager::getInstance()->select($sql);
                    if(empty($test)) {
                        $data = array("jour" => $jour[$k], "time_strat" => $time_start[$k], "time_end" => $time_end[$k], "id_bloc" => $id_bloc[$k], "id_user" => $id,);
                        $rest = DBManager::getInstance()->insert('agend', $data);
                    }
                }
            }
            if ($rest) {
                $_SESSION['message'] = 'Données enregistrées avec succès';
                $_SESSION['type'] = 'success';
                header("Location: index.php?coach=user");
            } else {
                $_SESSION['message'] = 'erreur: l\'enregistrement n\'a pas pu être inséré';
                $_SESSION['type'] = 'danger';
                header("Location: index.php?coach=affect");
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getTrinigJeson(){
        try {
            $sql = "select 	SUBSTR(tn.libelle, 1, 2) as type_nage,
                    m.metre as M, 
                    n.numero as D,
					e.date
                    from entrenement_nagetype as en
                    left join nagetype as tn on tn.id = en.id_nagetype
                    left join numero as n on n.id = en.id_num
                    left join metre as m on m.id = en.id_metre
                    inner join entrenement as e on e.id = en.id_entrenement and DATE(e.date) = DATE(NOW())
            ";
            $res = DBManager::getInstance()->select($sql);
            return json_encode($res);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getTriniByUser($id){
        try {
            $jour = array(1 => 'Sunday',
                2 => 'Monday',
                3 => 'Tuesday',
                4 => 'Wednesday',
                5 => 'Thursday',
                6 => 'Friday',
                7 => 'Saturday');
            $sql = "select a.*, b.label  from agend as a left join bloc as b on b.id = a.id_bloc where a.id_user = ". $id;
            $result = DBManager::getInstance()->select($sql);
            $array = array();
            foreach($result as $val){
                $time_start = date("H:i:s", strtotime('-10 minutes',strtotime($val['time_strat'])));
                $time_end = date("H:i:s", strtotime('+10 minutes',strtotime($val['time_end'])));
                $sql = "select * from user_entrenement 
                where DAYOFWEEK(date) = '".array_search($val['jour'], $jour)."'
                and (DATE_FORMAT(date , '%H:%i:%s') >= '".$time_start."' and DATE_FORMAT(date , '%H:%i:%s') <= '".$time_end."')
                and LOWER(lanes) LIKE '".strtolower($val['label'])."'
                ";
                $res = DBManager::getInstance()->row($sql);
                if($res)
                    $array[]=$res;
            }
            return $array;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
	
	public function entrenementUser($id, $id_coach)
    {
        try {
			$jour = array(1 => 'Sunday',
                2 => 'Monday',
                3 => 'Tuesday',
                4 => 'Wednesday',
                5 => 'Thursday',
                6 => 'Friday',
                7 => 'Saturday');
			$sql = "select a.*, b.label  from agend as a left join bloc as b on b.id = a.id_bloc where a.id_user = ". $id;
            $result = DBManager::getInstance()->select($sql);
            $array = array();
            foreach($result as $val){
				$sql = "select * from entrenement where  DAYOFWEEK(date) = '".array_search($val['jour'], $jour)."' and id_coach = " . $id_coach;
				$res = DBManager::getInstance()->row($sql);
                if($res)

                    $array[]=$res;
			}
			
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
	public function showTraining($id)
    {
        try {
			$sql = "select 	tn.libelle,
                    m.metre as M, 
                    n.numero as D
                    from entrenement_nagetype as en
                    left join nagetype as tn on tn.id = en.id_nagetype
                    left join numero as n on n.id = en.id_num
                    left join metre as m on m.id = en.id_metre
					where en.id_entrenement = ". $id;
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
	
	public function getAgenda($id)
    {
        try {
			$sql = "select a.*, b.label from agend as a 
				left join bloc as b on b.id = a.id_bloc
				where a.id_user = ". $id;
            $res = DBManager::getInstance()->select($sql);
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}