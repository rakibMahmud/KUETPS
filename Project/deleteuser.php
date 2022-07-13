<?php 
 include 'config.php';

 $userid = $_GET['id'];


 $sql1 = "SELECT * FROM `users` WHERE id =  $userid";
 $result1=  mysqli_query($conn, $sql1) or die("sql1 failed");
 $row = mysqli_fetch_assoc($result1);
 unlink("image/".$row['profileimage']);


 $sql = "DELETE FROM `users` WHERE id =  $userid";
 $result = mysqli_query($conn, $sql) or die("sql failed");
 //for user




 $sql3 = "SELECT * FROM `post` WHERE userid =  $userid";
 $result3=  mysqli_query($conn, $sql3) or die("sql3 failed"); 
 while($row3 = mysqli_fetch_assoc($result3)) { 
    unlink("image/".$row3['userimg']);
    $sql4 = "DELETE FROM `post` WHERE userid =  $userid";
    $result4 = mysqli_query($conn, $sql4) or die("sql4 failed");
 }



 // for user's post


 $sql5 = "DELETE FROM `comments` WHERE userid =  $userid";
 $result5 = mysqli_query($conn, $sql5) or die("sql5 failed");

 //for user's comment

 $sql6 = "DELETE FROM `rating_info` WHERE user_id =  $userid";
 $result6 = mysqli_query($conn, $sql6) or die("sql6 failed");

 //for user's like dislike

 header("Location:allusers.php");
?>