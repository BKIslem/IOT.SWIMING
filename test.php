<?php
$servername="localhost";//parametre de connexion
$username="root";
$password="";
$dbname="swim";

echo $servername;
echo $servername;
echo $dbname;

if (isset($_GET['lanes'])){//verifier si il existe de variable ou nn
$object_conn = $_GET['lanes'];
$object_value = $_GET['duree'];
echo $object_conn;
echo $object_value;
echo "<br>vous avez mis la duree :";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("connection failed: " . $conn->connect_error);
}
echo "connected successfully";

}
	else {echo "0 results";}
$sql ="INSERT INTO `swim`.`user_entrenement` (`lanes`, `duree`, `date`) VALUES ('$object_conn', '$object_value', Now())";
echo $sql;
if ($conn->query($sql) === TRUE) {
	
	
echo "<br>New record created successfully"; 
}
else { 
echo "chy";
}


$conn->close();



//else {echo "<br>ikteb_el_ocs";}
?>