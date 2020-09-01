<?php
session_start();
include "include/dbcon.php";

$username=$useriddb=$pass=$msg=$typedb=$statusdb=$passwordb=$fnamedb=$msg1=$today=$lastlogin=$daycount="";
$today=date("Y-m-d");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  if(!empty($_POST['username']))
  {
    $username=mysqli_real_escape_string($conn,$_POST['username']);
  }
  if(!empty($_POST['password']))
  {
    $pass=mysqli_real_escape_string($conn,$_POST['password']);
  }

  $sql="select * from user where user_name='$username'";
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)==0)
  {
    $msg="Incorrect UserName";
  }
  if(mysqli_num_rows($result)!=0) {
    //$resultTable=mysqli_fetch_assoc($result);
    while($row=mysqli_fetch_assoc($result))
    {
      $passwordb=$row['password'];
      $useriddb=$row['user_id'];
      $fnamedb=$row['full_name'];
      $typedb=$row['user_type'];
      $statusdb=$row['status'];
      $lastlogin=$row['last_login_date'];
    }
    if(password_verify($pass, $passwordb))
    {

      if($typedb=="admin")
      {
        $_SESSION['type'] = $typedb;
        $_SESSION['user_name'] = $username;
        $sqldate="update user set last_login_date='$today' where user_name='$username'";
        mysqli_query($conn,$sqldate);
        header("Location: admin/admin.php");
      }

      if($typedb=="buyer")
      {
        $sqldate="update user set last_login_date='$today' where user_name='$username'";
        mysqli_query($conn,$sqldate);
        $_SESSION['type'] = $typedb;
        $_SESSION['user_name'] = $username;
        header("Location: buyer/buyer.php");
      }

      if($typedb=="seller")
      {
        if($statusdb=="approved")
        {

          $daycountsql="SELECT DATEDIFF('$today', '$lastlogin')'date'";
          $daycountresult=mysqli_query($conn,$daycountsql);
          while($row1=mysqli_fetch_assoc($daycountresult))
          {
            $daycount=$row1['date'];
          }

          if($daycount<=30)
          {
            $_SESSION['fname'] = $fnamedb;
            $_SESSION['user_id'] = $useriddb;
            $_SESSION['type'] = $typedb;
            $_SESSION['user_name'] = $username;
            $sqldate="update user set last_login_date='$today' where user_name='$username'";
            mysqli_query($conn,$sqldate);
            header("Location: seller/sellers_published_books.php");
          }
          else if($daycount>30)
          {
            $suspendsql="UPDATE user SET status ='suspended' WHERE user.user_id = $useriddb";
            mysqli_query($conn,$suspendsql);
            $msg="Your Account Has Been Suspended ! ";
          }


      }

         else if($statusdb=="not approved")
        {
          $msg="Your Account Not Approved Yet";
        }

        else if($statusdb=="suspended")
       {
         $msg="Your Account Has Been Suspended ! Contact To The Admin To Make It Active Again ";
       }
      }

    }

    if(!password_verify($pass, $passwordb))
    {
      $msg1="Incorrect Password";
    }





  }

}



mysqli_close($conn);

 ?>






<html>
<head>
  <title>Login</title>
  <link rel = "icon" href =
"https://media.geeksforgeeks.org/wp-content/cdn-uploads/gfg_200X200.png"
        type = "image/x-icon">
</head>
<link rel="stylesheet" href="style.css">
<body>
  <div class="body">
    <form class="" action="login.php" method="post">
      <h1>Welcome</h1>
      <table>
        <tr>
          <td><label for=""> username</label></td>
          <td><input type="text" name="username" value="" required><br></td>
          <td><label class="warning"> <?php echo $msg;
         ?></label></td>
        </tr>
        <tr>
          <td><label for="">password</label></td>
          <td><input type="password" name="password" value="" required><br></td>
          <td><label class="warning"> <?php echo $msg1;
         ?></label></td
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="btn1" value="Log In" class="btn">
            <a href="reg.php">Regestation</a>
          </td>
        </tr>

      </table>


    </form>

  </div>


</body>


</html>
