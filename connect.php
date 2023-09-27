<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "userdb";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    echo "Database successfully connected";
}
else{
    echo "Error";
}

?>


