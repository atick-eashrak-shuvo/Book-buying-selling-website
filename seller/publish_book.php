<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['type']!="seller")
{
  header("Location: ../logout.php");
}
$username=$_SESSION['user_name'];
include "../include/dbcon.php";
$sql="select * from books";
$result=mysqli_query($conn,$sql);

$book_price=$book_condition=$book_id=$book_copy=$book_discount=$location="";


if($_SERVER["REQUEST_METHOD"] == "POST")
{
  if(!empty($_POST['book']))
  {
  $book_id= mysqli_real_escape_string($conn,$_POST['book']);
  }

  if(!empty($_POST['book_condition']))
  {
  $book_condition= mysqli_real_escape_string($conn,$_POST['book_condition']);
  }

  if(!empty($_POST['book_price']))
  {
  $book_price= mysqli_real_escape_string($conn,$_POST['book_price']);
  }

  if(!empty($_POST['book_copy']))
  {
  $book_copy= mysqli_real_escape_string($conn,$_POST['book_copy']);
  }

  if(!empty($_POST['book_discount']))
  {
  $book_discount= mysqli_real_escape_string($conn,$_POST['book_discount']);
  }

  if(!empty($_POST['location']))
  {
  $location= mysqli_real_escape_string($conn,$_POST['location']);
  }

  $sql1="INSERT INTO `book_ad` (`book_id`, `user_name`, `book_condition_status`, `discount`, `quantity`, `price`, `location`, `ad_id`) VALUES ('$book_id', '$username', '$book_condition', '$book_discount', '$book_copy', '$book_price', '$location', NULL)";
  mysqli_query($conn,$sql1);
  echo "success";



}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Publish Book</title>
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
        <div class="container">
            <form class="" action="publish_book.php" method="post">
              <table class="table">
              <div id="error-message" class="text-danger"></div><div id="success-message" class="text-success"></div>
                  <tr>
                      <td></td>
                      <td>Book: </td>
                      <td>
                          <select  class="form-control" name="book" id="book">
                              <option value="0">Select One</option>
                              <?php while($row=mysqli_fetch_assoc($result)) {?>
                              <option value="<?php echo $row['book_id']; ?>"><?php echo $row['book_name']; ?></option>
                            <?php } ?>
                          </select>
                      </td>
                      <td>
                          <div class="text-danger">*</div>
                      </td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td>Book Condition:</td>
                      <td>
                          <select  class="form-control" name="book_condition" id="book_condition">
                              <option value="new">New</option>
                              <option value="old">Old</option>
                          </select>
                          <!-- <input  class="form-control" type="text" value="" name="book_condition" id="book_condition"></input> -->
                        </td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td>Price:</td>
                      <td><input  class="form-control" type="number" name="book_price" id="book_price"></td>
                      <td> <div class="text-danger">*</div></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td>Number of Copy:</td>
                      <td><input  class="form-control" type="number" name="book_copy" id="book_copy"></td>
                      <td> <div class="text-danger">*</div></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td>Discount (Percentage):</td>
                      <td><input  class="form-control" type="number" value="0" name="book_discount" id="book_discount"></td>
                      <td> <div class="text-danger">*</div></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td>Location:</td>
                      <td><input  class="form-control" type="text" value="" name="location" id="book_location"></td>
                      <td> <div class="text-danger">*</div></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td><input type="submit" name="submit" class="form-control" value="Publish" ></td>

                      <td></td>
                      <td></td>
                  </tr>

              </table>

            </form>




        </div>

    </body>
    <script>
      $(document).ready(function () {
        // $.ajax({
        //     dataType: "json",
        //     url: 'ajax/load_books.php',
        //     data: 1,
        //     success: function(data){
        //         console.log(data);
        //         $.each(data, function(res) {
        //              $('#book').append($("<option />").val(data[res].book_id).text(data[res].book_name));
        //         });
        //     }
        // });
        $('form').on('submit', function (e) {
            e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: 'ajax/save_bookad.php',
                    data: $('form').serialize(),
                    success: function (data) {
                        if(data.error==""){
                            $("#error-message").text(data.error);
                            $("#success-message").text(data.success);
                        }else{
                            $("#error-message").text(data.error);
                            $("#success-message").text(data.success);
                        }
                    }
                });

            });
        });
    </script>
</html>
