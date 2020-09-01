<?php
include "include/dbcon.php";
$fname=$email=$pno=$utype=$uname=$pw=$repw=$msg=$msg1=$sts=$sqlinsert=$unamedb="";
$fnameerr=$emailerr=$pnoerr=$utypeerr=$unameerr=$pwerr=$repwerr="";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  if(!empty($_POST['f_name']))
  {
    $fname= mysqli_real_escape_string($conn,$_POST['f_name']);
  }
  else {
    $fnameerr="This Field Can Not Be empty";
  }

  if(!empty($_POST['email']))
  {
    $email= mysqli_real_escape_string($conn,$_POST['email']);
  }
  else {
    $emailerr="This Field Can Not Be empty";
  }

  if(!empty($_POST['p_no']))
  {
    $pno= mysqli_real_escape_string($conn,$_POST['p_no']);
  }
  else {
    $pnoerr="This Field Can Not Be empty";
  }

  if(!empty($_POST['u_type']))
  {
    $utype= mysqli_real_escape_string($conn,$_POST['u_type']);
  }
  else {
    $utypeerr="This Field Can Not Be empty";
  }

  if(!empty($_POST['u_name']))
  {
    $uname= mysqli_real_escape_string($conn,$_POST['u_name']);
  }
  else {
    $unameerr="This Field Can Not Be empty";
  }

  if(!empty($_POST['pw']))
  {
    $pw= mysqli_real_escape_string($conn,$_POST['pw']);
    $pwdb = password_hash($pw, PASSWORD_DEFAULT);
  }
  else {
    $pwerr="This Field Can Not Be empty";
  }

  if(!empty($_POST['re_pw']))
  {
    $repw= mysqli_real_escape_string($conn,$_POST['re_pw']);
  }
  else {
    $repwerr="This Field Can Not Be empty";
  }

  $sqlUserCheck="select user_name from user where user_name='$uname'";
  $result=mysqli_query($conn, $sqlUserCheck);
  while($row=mysqli_fetch_assoc($result))
  {
    $unamedb=$row['user_name'];
  }
  if($unamedb==$uname)
  {
    $msg="Username Already Taken";
  }
  else  {
  if($pw==$repw)
  {
    if($utype=="buyer")
    {
      $sqlinsert="INSERT INTO `user` (`full_name`, `email`, `phono_no`, `user_type`, `user_name`, `password`, `user_id`, `status`) VALUES ('$fname', '$email', '$pno', '$utype', '$uname', '$pwdb', NULL, 'approved')";
      mysqli_query($conn,$sqlinsert);
      header("Location: login.php");
    }

    if($utype=="seller")
    {
      $sqlinsert="INSERT INTO `user` (`full_name`, `email`, `phono_no`, `user_type`, `user_name`, `password`, `user_id`, `status`) VALUES ('$fname', '$email', '$pno', '$utype', '$uname', '$pwdb', NULL, 'not approved')";
      mysqli_query($conn,$sqlinsert);
      header("Location: login.php");
    }

  }
  else if($pw!=$repw) {
    $msg1= "Password Dosen't Match";

  }

}
}




?>


<html lang="en" dir="ltr">
<link rel="stylesheet" href="style.css">
  <head>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script>
      $(document).ready(function(){

         $("#txt_username").keyup(function(){

            var username = $(this).val().trim();

            if(username != ''){

               $.ajax({
                  url: 'checkdata.php',
                  type: 'post',
                  data: {username: username},
                  success: function(response){

                      $('#uname_response').html(response);

                   }
               });
            }else{
               $("#uname_response").html("");
            }

          });

       });
      </script>


    <meta charset="utf-8">
    <title>Registration</title>
  </head>
  <body>
    <form class="" action="reg.php" method="post" onsubmit="return checkall();">
      <div class="body">
        <h1>Regestation</h1><br>
        <table>
          <tr>
            <td><label for="">Full Name:</label> </td>
            <td><input type="text" name="f_name" value="" required> </td>
          </tr>
          <tr>
            <td><label for="">Email:</label> </td>
            <td><input type="email" name="email" id="UserEmail" value=""  required> </td>
            <td><span id="email_status"></span></td>
          </tr>
          <tr>
            <td><label for="">Phone No:</label> </td>
            <td><input type="text" name="p_no" value="" required> </td>
          </tr>
          <tr>
            <td><label for="">User Type:</label> </td>
            <td><select class="" name="u_type" required>
              <option value=""disabled selected>Select User Type</option>
              <option value="buyer">Buyer</option>
              <option value="seller">Seller</option>

            </select> </td>
          </tr>
          <tr>
            <td><label for="">Username:</label> </td>
            <td><input type="text" name="u_name" id="txt_username" value=""  required> </td>
            <td><label class="warning"><div id="uname_response" ></div><?php echo $msg;
             ?></label> </td>
          </tr>

          <tr>
            <td><label for="">Password:</label> </td>
            <td><input type="password" name="pw"  id="pw" required> </td>
          </tr>
          <tr>
            <td><label for="">Re-type Password:</label> </td>
            <td><input type="password" name="re_pw" id="re_pw"  onkeyup='check();' required> </td>
            <span id='message'></span>
            <td><label class="warning" id="pww"> <?php
            echo $msg1; ?></label> </td>
          </tr>

          <tr>
            <td></td>
            <td><input type="submit" name="reg_btn" value="Regestation">
            <a href="login.php">Login</a> </td>
          </tr>
        </table>

      </div>

</form>

  <script >

      var check = function() {
    if (document.getElementById('pw').value ==
      document.getElementById('re_pw').value) {
      document.getElementById('pww').style.color = 'green';
      document.getElementById('pww').innerHTML = 'matching';
    } else {
      document.getElementById('pww').style.color = 'red';
      document.getElementById('pww').innerHTML = 'not matching';
    }
    }

  </script>



  </body>
</html>
