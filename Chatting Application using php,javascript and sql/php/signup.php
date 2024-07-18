<?php
 session_start();
include_once "config.php";
$fname = mysqli_real_escape_string($conn,$_POST['fname']);
$lname = mysqli_real_escape_string($conn,$_POST['lname']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){

     //let's check user email is valid or not
     if(filter_var($email, FILTER_VALIDATE_EMAIL)) {    //THE validate statement which check if the email is valid
        // let's check if that email already exits in tha database
        $sql = mysqli_query($conn, "SELECT email from users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0 ){ //statemenent to check email already exist
            echo "$email - this email already exist";
        }else{
            //checking user upload file or not 
            if(isset($_FILES['image'])){  // if the  file uploaded
              $img_name = $_FILES['image']['name']; // getting user uploaded img_name
               $tmp_name = $_FILES['image']['tmp_name']; //this temporary name is used to save/move file in our folder 
                 
               //let's explode image and get the last extension like png,jng
               $img_explode = explode('.',  $img_name);
               $img_ext = end( $img_explode);  //here we get the extension of the user uploaded img file

                $extensions = ['png', 'jpeg', 'jnp']; // here are some valid img_ext and we've store them in array   
               if(in_array( $img_ext, $extensions) === true){ //if user uploaded img_ext is matched with an array extension
                $time = time();//this will return current time
                                // we need this time because when uploading user img to in our folder we rename user file with current time
                                //so all file img file will have unique

                    // let's move the user uploaded img to our particular folder
    
                $new_img_name = $time.$img_name;
              if(move_uploaded_file($tmp_name,"image/".$new_img_name)) { //if user upload img move to our folder successfully    
                $status = "Active Now";   // once user signed up the his status will be active
                $random_id = rand(time(), 1000000);  //creating a random id for user

                // let's insert all the user data inside table
                $sql2 = mysqli_query($conn, "INSERT INTO users (fname, lname, unique_id, email, password, img, status)
                VALUES('{$fname}','{$lname}', {$random_id}, '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

                if($sql2){ // checks if data is inserted
                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                if(mysqli_num_rows($sql3) > 0){
                    $row = mysqli_fetch_assoc($sql3); //declare the varaible name $row 
                    $_SESSION['unique_id'] = $row['unique_id']; //using the session we used user unique_id in other php file
                    echo "success";
                }

                }else{
                    echo "Something went Wrong";
                }
              }
               
               } else{
                echo "please select an image-file eg jpeg,png,jpg";
               }
              
            } else{
                echo "please select an image file";
            }
        }
     }else{
        echo "$email - this email is not valid!";
     }
} else{
    echo "All input field are required";
}


?>