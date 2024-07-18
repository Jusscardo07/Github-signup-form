<?php 
while($row = mysqli_fetch_assoc($sql)){ 
    $sql2 = "SELECT * FROM tblmessage WHERE (incoming_msg_id = {$row['unique_id']} 
      OR outgoing_msg_id = {$row['unique_id']}) AND (incoming_msg_id = {$outgoing_id}  
      OR outgoing_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if(mysqli_num_rows($query2) > 0){
        $result = $row2['msg'];
    } else{
        $result = "No message available";  
    }

    //trimming messagesif words are more than 28
   (strlen($result) > 28) ? $msg = substr($result, 0, 28). '...' : $msg = $result; // the function to declare user's last messages

   // adding the you function before msg if login id send msg
   ($outgoing_id == $row2['outgoing_msg_id']) ? $You = "You: " : $You = "";
  
    //Check if user active or not
    ($row['status'] == "offline now") ? $Offline = "offline" : $Offline = ""; 

    $output .= '<a href="chatArea.php? user_id= '.$row['unique_id'].'">
    <div class="content">
        <img src="php/image/'. $row['img'] .'" alt="">
        <div class="details">
        <span>'. $row['fname'] . " " . $row['lname'] .'</span>
        <p>'. $You . $msg.'</p>
    </div>
    </div>
    <div class="status-dot '.$Offline.'"><i class="bx bxs-circle"></i></div>
</a>';
} 
?>
