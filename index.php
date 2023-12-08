<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "img";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("you not connected to the database");
}

else{
   
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST["title"];
        //$images = $_POST["images"];

        // Handle file upload
        $target_dir = "uploads/"; // Create a directory to store uploaded images
        $target_file = $target_dir . basename($_FILES["images"]["name"]);
        move_uploaded_file($_FILES["images"]["tmp_name"], $target_file);

        $sql = "INSERT INTO `image` (`title`, `images`) VALUES ('$title', '$target_file')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>Successfully!</strong> Your Data Will be Inserted Successfully.
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
        } 
        else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Data Will Not Inserted Successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
   <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
   

    <title>Upload Multiple Images</title>
  </head>
  <body>
  	<div class="container mt-5">
    <form action ="/Image/index.php" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="title" class="form-label">Product Title</label>
    <input type="text" class="form-control" id="title" name="title">
   
  </div>
  <div class="mb-3">
    <label for="images" class="form-label">Product Images</label>
    <input type="file" class="form-control" id="images" name="images" multiple>
  </div>
  <button type="submit" class="btn btn-primary">Add Product</button>
</form>
</div>


<div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Product Title</th>
          <th scope="col">Product Images</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `image`";
           $result = mysqli_query($conn, $sql);
           $id = 0;
           while($row = mysqli_fetch_assoc($result)){
            $id = $id + 1;
            echo '<tr>
            <th scope="row">'. $id . '</th>
            <td>'. $row['title'] . '</td>
             <td><img src="' . $row['images'] . '" alt="Product Image" style="max-width: 100px;"></td>
            <td> <button class="edit btn btn-sm btn-primary" id= '.$row['id'].' >Edit</button>
             <button class="delete btn btn-sm btn-primary" id= '.$row['id'].' >Delete</button> </td>
          </tr>';
        } 
          ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
   
  </body>
</html>