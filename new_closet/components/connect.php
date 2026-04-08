
<!--connecting to database--->
<?php
$db_name = 'mysql:host=localhost;dbname=newcloset_db';
$db_user_name = 'root';
$db_user_pass= '';
//connecting to new pdo (Prepared Statement)
$conn = new PDO($db_name, $db_user_name, $db_user_pass);
function create_unique_id()
{
$sets = ['abcdefghijklmnopqstuvxyz','ABCDEFGHIJKLMNOPQRSTUVWXYZ','1234567890'];
$all = implode('', $sets);
$id =  $sets[0][random_int(0, 25)]
     . $sets[1][random_int(0, 25)]
     . $sets[2][random_int(0, 9)];

for($i = 0; $i < 20; $i++) $id .= $all[random_int(0, strlen($all) - 1)];
return str_shuffle($id);
};
?>  
