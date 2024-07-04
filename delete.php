<?php

include 'data.php';
$id = $_GET['upid'];
$sql = "DELETE FROM `notes` WHERE `id` = '$id'";
if (mysqli_query($conn, $sql)) {   
$message= "Record deleted Successfully";
header("Location: mynotes.php");
exit();     
    
} else {
$message= "Error  deleting the Record Successfully";
header("Location: mynotes.php");
exit();     
}


?>