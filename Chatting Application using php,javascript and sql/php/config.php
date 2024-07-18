<?php
$conn = mysqli_connect("localhost" , "root" ,"", "chat");
if(!$conn){
    echo "database connnected" .mysqli_connect_error();
} 
?>