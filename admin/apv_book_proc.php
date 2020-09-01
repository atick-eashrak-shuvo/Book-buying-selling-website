<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['type']!="admin")
{
  header("Location: logout.php");
}
include "../include/dbcon.php";




$userid=$sql1=$sql2=$result2=$book_name=$author=$category=$summary=$cover_photo=$sql3="";

if($_SERVER["REQUEST_METHOD"]=="GET")
{
  if(!empty($_GET['x']))
  {
    $userid=$_GET['x'];

    $sql2="SELECT * from book_request where request_id='$userid'";
    $result2=mysqli_query($conn,$sql2);
    while ($row=mysqli_fetch_assoc($result2)) {

      $book_name=$row['book_name'];
      $author=$row['author'];
      $category=$row['category'];
      $summary=$row['summary'];
      $cover_photo=$row['cover_photo'];

    }
    $sql1="INSERT INTO `books` (`book_id`, `book_name`, `author`, `category`, `summary`, `cover_photo`) VALUES (NULL, '$book_name','$author','$category','$summary','$cover_photo')";
    mysqli_query($conn,$sql1);
    $sql3="DELETE FROM books_request WHERE request_id ='$userid'";
    mysqli_query($conn,$sql3);
  }


}

header("Location: apv_book_rmv.php?x=$userid");
?>
