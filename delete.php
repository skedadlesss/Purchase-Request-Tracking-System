<?php

include 'connect.php';

if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];


    $sql="DELETE FROM pending WHERE id=$id";

    $result=mysqli_query($conn,$sql);
    if($result){
        echo 'succesfully deleted';
        header("Location: admin-pending.php");
    }else{
        die(mysqli_error($conn));
    }

}


?>