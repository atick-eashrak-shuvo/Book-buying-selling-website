<?php
include "../include/dbcon.php";

if(isset($_POST['username'])){
   $username = $_POST['username'];

   $query = "select * from user where user_name='".$username."'";

   $result = mysqli_query($conn,$query);
   $response = "<span style='color: green;'>Available.</span>";
   if(mysqli_num_rows($result)>0){
     $response = "<span style='color: red;'>Not Available.</span>";

 }


   }

   echo $response;
   die;
?>
