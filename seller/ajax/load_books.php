<?php
    // if(!isset($_SESSION['user_name']) || $_SESSION['type']!="admin")
    // {
    //   header("Location: logout.php");
    // }
    include "../../include/dbcon.php";
    
    $sql="SELECT * FROM books";
    $result=mysqli_query($conn,$sql);
    $data=array();
    while($row=mysqli_fetch_assoc($result)) {
        $data[]=$row;
    }
    /* free result set */
    mysqli_free_result($result);

    /* close connection */
    mysqli_close($conn);

    header('Content-Type: application/json');
    echo json_encode($data); 
?>