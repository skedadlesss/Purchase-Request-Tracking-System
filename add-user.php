<?php

include 'connect.php';

if(isset($_POST['submit'])){

    $username=$_POST['username'];
    $password=$_POST['password'];
    $fullname=$_POST['fullname'];
    $user_type=$_POST['type'];
  
    
    if {
    $username=$_POST['username'];
        $sql="INSERT INTO user (username,password,fullname,type) VALUES('$username','$password','$fullname','$type')";

        $result=mysqli_query($conn, $sql);

        if($result){
            echo "data inserted";
            header("Location: user-list.php");
        }else{
            die(mysqli_error($conn));
        }
    } 
   
}
    

?>