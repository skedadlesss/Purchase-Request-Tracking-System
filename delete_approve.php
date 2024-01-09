<?php

include 'connect.php';

if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];


    $sql="DELETE FROM approve WHERE id=$id";

    $result=mysqli_query($conn,$sql);
    if($result){
        echo 'succesfully deleted';
        header("Location: admin-approve.php");
    }else{
        die(mysqli_error($conn));
    }

}


?>