<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['type']!="admin")
{
  header("Location: logout.php");
}
  include "../include/dbcon.php";
    $sql="DELETE FROM user WHERE user_id='$_GET[id]'";
    mysqli_query($conn,$sql);
    if(mysqli_query($conn,$sql))
        header("refresh:1;url=deletebook.php");
else
    echo"Not Deleted";

?>
