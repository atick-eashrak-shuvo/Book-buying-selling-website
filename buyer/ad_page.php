<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['type']!="buyer")
{
  header("Location: ../logout.php");
}
if($_SERVER["REQUEST_METHOD"]=="GET")
{
  if(!empty($_GET['x']))
  {
    $ad_id=$_GET['x'];
  }
}
include "../include/dbcon.php";
$sql="SELECT books.book_name,books.cover_photo,book_ad.quantity,book_ad.price,user.user_name FROM book_ad,books,user WHERE books.book_id=book_ad.book_id and user.user_name=book_ad.user_name";
$result=mysqli_query($conn,$sql);

$sql1="SELECT user.full_name,user.phono_no,user.email,books.summary,books.book_name,books.cover_photo,books.author,book_ad.quantity,book_ad.price,user.user_name,book_ad.location FROM book_ad,books,user WHERE books.book_id=book_ad.book_id and user.user_name=book_ad.user_name and ad_id='$ad_id'";
$result1=mysqli_query($conn,$sql1);



?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Buyer</title>
    <link rel = "icon" href =
  "resource\icons8-admin-settings-male-100.png"
          type = "image/x-icon">
        <link rel="stylesheet" href="style.css">
  </head>
  <body>
<?php include "buyer_menu.php"; ?>


         <?php while($row=mysqli_fetch_assoc($result1)) { ?>

          <div style="display: block;">

          							  <center>
          								<div class="product-item">
          								  <div class="pi-img-wrapper">
          									<img src="../<?php echo $row['cover_photo']; ?>" class="img-responsive" alt="<?php echo $row['book_name']; ?>" style="height:300px;">
          								  </div>
          								  <h3><?php echo $row['book_name']; ?></h3>
          									<p>By:<?php echo $row['author']; ?> </p>
                            <p><?php echo $row['summary']; ?> </p>
                            <p>Location:<?php echo $row['location']; ?> </p>
                            <div class="pi-price">TK <?php echo $row['price']; ?></div>
                            <h4>Contact:</h4>
                            <p>Seller Name:<?php echo $row['full_name']; ?></p>
                            <p>email:<?php echo $row['email']; ?> </p>
                            <p>Phone No:<?php echo $row['phono_no']; ?> </p>

          								  </div>



          								</center>
                          </div>

              <?php } ?>
<?php include "footer.html"; ?>
  </body>
</html>
