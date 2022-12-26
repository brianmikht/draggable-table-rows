<?php
// Create connection
$db = mysqli_connect("localhost","user","","studycase"); 
// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

$position = $_POST['position'];
$i=1;
foreach($position as $k=>$v){
    $sql = "Update diri SET order_field='$i' WHERE id_diri='$v'";
    $db->query($sql);
	$i++;
}
?>