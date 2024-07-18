<?php
session_start();
include_once "config.php"; 
$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); //adding the search comment
$output = "";
$sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')"); //sql statemenent for search
if(mysqli_num_rows($sql) > 0){
    include "Data.php";
}else{
 $output .= "No User found related to your search term";
}
echo $output;
?>
