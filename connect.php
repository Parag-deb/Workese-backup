<?php
    $servername="localhost:3307";
    $username="root";
    $password="";
    $database="workesebackup";
    $conn=mysqli_connect($servername,$username,$password,$database);
    if($conn){
       // echo "connection is successfull.";
       //header("Location: index.php");
    }else{
         die("connection was not successfull".mysqli_connect_error());
    }


?>