<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller's Published Book</title>  <script>window.jQuery || document.write('<script src="../resource/js/jquery-3.4.1.js"><\/script>');</script>
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

            
        $sql="SELECT book_name,author,price,quantity,book_condition_status FROM books,book_ad,user where books.book_id= book_ad.book_id and user.user_name=book_ad.user_name and user.user_id='$userId'";
        
        $result=mysqli_query($conn,$sql);
        $data=array();
        while($row=mysqli_fetch_assoc($result)) {
            $data[]=$row;
        }
        /* free result set */
        mysqli_free_result($result);
        /* close connection */
        mysqli_close($conn);
    ?>
   <div class="container">
    <table class="table">
            <caption><h2>Seller's Published Book</h2></caption>
            <tr>
                <th>Book Name</th>
                <th>Author</th>
                <th>Price</th>
                <td>Avalable Copies</td>
                <td>Book condition</td>
            </tr>
            <?php
                foreach ( $data as &$value) {
                    ?>
                    <tr>
                        <td><?=$value['book_name']?></td>
                        <td><?=$value['author']?></td>
                        <td><?=$value['price']?></td>
                        <td><?=$value['quantity']?></td>
                        <td><?=$value['book_condition_status']?></td>
                    </tr>
                    <?php
                }
            ?>
        </table>  
   </div>  
</body>
</html>