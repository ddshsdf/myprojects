<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "userdb";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("you not connected to the database");
}

else{
   
    $username= $_POST['username'];
    $password= $_POST['password'];
    

    $sql = "INSERT INTO `users` (`username`, `password`) VALUES ( '$username', '$password')";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Data Inserted Successfully";
    }
    else{
        echo "Data is Not Inserted";
    }

}

