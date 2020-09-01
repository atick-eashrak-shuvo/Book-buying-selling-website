<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Request New Book</title>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../resource/js/jquery-3.4.1.js"><\/script>');</script>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<body>
  <?php include "seller_navbar.php"; ?>
    <?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['type']!="seller")
{
  header("Location: ../logout.php");
}
$userId=$_SESSION['user_id'];


include "../include/dbcon.php";
$id=$name=$author=$category=$summary=$cover_photo=$sql=$cploc="";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
    if(!empty($_POST['name'])){
        $name=($_POST['name']);
    }

    if(!empty($_POST['author'])){
        $author=($_POST['author']);
    }

    if(!empty($_POST['category'])){
        $category=($_POST['category']);
    }
    if(!empty($_POST['category'])){
        $category=($_POST['category']);
    }

    if(!empty($_POST['summary'])){
        $summary=($_POST['summary']);
    }

    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = date("mdhis").$_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $tmp = explode('.', $file_name);
        $file_type=$_FILES['image']['type'];
        $file_ext=end($tmp);

        $extensions= array("jpeg","jpg","png","PNG");

        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
        }

        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"../resource/book_cover/".$file_name);
            $cover_photo="resource/book_cover/";
            $cploc=$cover_photo.$file_name;
            echo "Success";

        }else{
            print_r($errors);
        }
        }

        $sql="INSERT INTO book_request(book_name,author,category,summary,cover_photo,user_id) VALUES ( '$name', '$author', '$category', '$summary', '$cploc','$userId')";
        mysqli_query($conn,$sql);
    }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Book Request</title>
  </head>
  <body>
    <div class="container">
      <form class="" action="request_book.php" method="post" enctype="multipart/form-data">
        <table class="table">
            <tr>
            <td><label for=""> Book Name:</label></td>
            <td><input  class="form-control" type="text" name="name" value="" > </td>
            </tr>
            <tr>
            <td><label for=""> Author/(s):</label></td>
            <td><input  class="form-control" type="text" name="author" value="" > </td>
            </tr>
            <tr>
            <td><label for=""> Category:</label></td>
            <td><input  class="form-control" type="text" name="category" value="" > </td>
            </tr>
            <tr>
            <td><label for=""> Summary:</label></td>
            <td><textarea  class="form-control" name="summary" rows="8" cols="80" ></textarea> </td>
            </tr>
            <tr>
            <td><label for="">Cover Photo:</label> </td>
            <td><input  class="form-control" type="file" name="image" required></td>
            </tr>
            <tr>
            <td></td>
            <td><input  type="submit" name="btn_bookrequest" value="Request"> </td>
            </tr>
        </table>
      </form>
    </div>
  </body>
</html>
  


</body>
</html>