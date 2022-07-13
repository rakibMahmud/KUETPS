<?php 
 include 'config.php';

 $postid = $_GET['id'];
 $sql1 = "SELECT * FROM `post` WHERE post_id =  $postid";
 $result1=  mysqli_query($conn, $sql1) or die("sql1 failed");
 $row = mysqli_fetch_assoc($result1);
 unlink("image/".$row['userimg']);
 $sql = "DELETE FROM `post` WHERE post_id =  $postid";
 $result = mysqli_query($conn, $sql) or die("sql failed");
 header("Location:userhomepage.php");
?>