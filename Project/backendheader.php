<?php
 include 'config.php';

 if(isset($_SESSION["last_login_timestamp"]))  {
    if((time() - $_SESSION['last_login_timestamp']) > 60*10){
        header("Location: logout.php");
     }
 } 

 $_SESSION['last_login_timestamp'] = time(); //code for inactive user (কখন লগইন করেছে সেই সময়)  
if(!isset($_SESSION["id"])){
    header("Location: index.html");
}
             
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>KUETPS</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 left_side">
             <?php                
                                $sql1 = "SELECT * FROM `users` WHERE id= {$_SESSION['id']}";
                                $result1 = mysqli_query($conn, $sql1,) or die("sql1 failed");
                                while($row = mysqli_fetch_assoc($result1)) { ?>
                                <?php 
                                if( $row['profileimage'] == NULL){?>
                                    <img src="images/profile.png" class="w-100" alt="">
                                <?php } ?> 

                                <?php 
                                if( $row['profileimage']){?>
                                    <img src="image/<?php echo $row['profileimage']; ?>" class="w-100 mb-3" alt="">
                                <?php } ?>  
                                <?php } ?>
                            
                
                <ul>
                    <li><a href="userhomepage.php">Home</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="mypost.php">My Post</a></li>
                    
                   
                     <?php                  
                      if($_SESSION["role"] == '1'){ ?>
                      <li><a href="allusers.php">All Users</a></li>
                    
                        <?php   }
                    
                    ?>
                     
                   
                       
                </ul>
            </div>
            <div class="col-md-10 right_side">
                <nav class="shadow navbar navbar-expand-lg navbar-light bg-light">                
                    <a class="navbar-brand" href="#">HI... <?php echo $_SESSION["full_name"];  ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <!-- for media query -->
                        <span class="navbar-toggler-icon"></span>
                        <!-- small device icon  -->
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>