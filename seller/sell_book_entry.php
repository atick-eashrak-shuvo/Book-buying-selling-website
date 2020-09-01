<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['type']!="seller")
{
  header("Location: ../logout.php");
}
$usename=$_SESSION['user_name'];
include "../include/dbcon.php";


$sql="select * from books where books.book_id in (SELECT DISTINCT book_id FROM `book_ad` where quantity>0 and user_name='$usename')";
$result=mysqli_query($conn,$sql);



 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Book Entry</title>
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
            <form class="" action="sell_book_entry.php" method="post">
                <table class="table">
                    <caption><div id="error-message" class="text-danger"></div><div id="success-message" class="text-success"></div></caption>
                    <tr>
                        <td></td>
                        <td>Book: </td>
                        <td>
                            <select  class="form-control" name="book" id="book">
                                <option value="0">Select One</option>
                                <?php while($row=mysqli_fetch_assoc($result)){ ?>
                                  <option value="<?php echo $row['book_id']; ?>"><?php echo $row['book_name']; ?> </option>
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
                            <!-- <input  class="form-control" type="checkbox" value="new" name="book_condition" id="book_condition"> -->
                        </td>
                        <td></td>
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
                        <td></td>
                        <td><input  name="submit" id="submit" value="Sell Book" type="submit"></td>
                        <td></td>
                        <td></td>
                    </tr>

                </table>
            </form>
        </div>

</body>
<script>
      $(document).ready(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: 'ajax/save_sell_book.php',
                    data: $('form').serialize(),
                    success: function (data) {
                        console.log(data);
                        if(data.error==""){
                            //alert(data.success);
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
