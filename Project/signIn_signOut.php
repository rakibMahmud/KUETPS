<?php
session_start(); 
$hostname = "localhost";
$username = "root";
$password = "";
$database = "login_register_kuetps";

$conn = mysqli_connect($hostname, $username, $password, $database) or die("Database connection failed");

 if(isset($_POST['signin'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $sql) or die("sql failed");
  if(mysqli_num_rows($result)>0){
      // cookie code start 
      if(isset($_POST['remebering'])){
        setcookie('email',$email,time()+ 60*60*24*365);
        setcookie('password',$password,time()+ 60*60*24*365);
      }else{
        setcookie('email',$email,30);
        setcookie('password',$password,30);
      }
      // cookie code end 
    while($row = mysqli_fetch_assoc($result)) {        
      $_SESSION["id"] = $row['id'];
      $_SESSION["full_name"] = $row['full_name'];
      $_SESSION["role"] = $row['role'];    
      header("Location:userhomepage.php");
    }
  }
  else{
    echo'
    <script>
    alert("invalid email or password");
    window.location.href = "signIn_signOut.php";
    </script>';
  }
 } 
//  if cookie exist code start
$email_cookie = '';
$password_cookie ='';
$set_remember ='';
if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
  $email_cookie = $_COOKIE['email'];
  $password_cookie = $_COOKIE['password'];
  $set_remember = "checked='checked'";
}
//  if cookie exist code end
 if(isset($_SESSION["id"])){
  header("Location: userhomepage.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/signIn_signOut.css" />
  <title>Sign in & Sign up Form - KUETPS</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" method="post" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Email Address" name="email" value="<?php echo $email_cookie ?>" required />
           
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" value="<?php echo $password_cookie ?>" required />
          </div>
          <div class="remember" style="display: flex;justify-content: center;align-items: center;margin-top: 5px;">
                <input type="checkbox" <?php echo $set_remember ?> name="remebering" id="remebering" style="padding: right 2px;">
                <label for="remebering">Remeber me</label>
          </div>
          <input type="submit" value="Login" name="signin" class="btn solid" />
          
        </form>
        <?php
          if(isset($_POST['signup'])){
            $signup_full_name = $_POST['signup_full_name'];
            $signup_email = $_POST['signup_email'];          
            $signup_password = $_POST['signup_password'];
            $signup_cpassword = $_POST['signup_cpassword'];
            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$signup_email'" ))>0){
              echo'
              <script>
              alert("email already exists");
              window.location.href = "signIn_signOut.php";
              </script>';
            }
            elseif($signup_password == $signup_cpassword){
              $sql1 = "INSERT INTO `users`(`full_name`, `email`,`role`, `password`) VALUES ('$signup_full_name','$signup_email','2','$signup_password')";
              $result1 = mysqli_query($conn, $sql1) or die("sql1 failed");         
              echo'
              <script>
              alert("registraton successfully");
              window.location.href = "signIn_signOut.php";
              </script>';
            }
            
            else{
              echo'
              <script>
              alert("password and confirm password are not same");
              window.location.href = "signIn_signOut.php";
              </script>';
            }
         
          }
        ?>
        <form action="" class="sign-up-form" method="post">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
        <input type="text" placeholder="Full Name" name="signup_full_name"  required />
              <!-- registration korar pore successful na hole value gula dekhabe signup e er jonno php echo...same for sign in -->
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email Address" name="signup_email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="signup_password"  required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Confirm Password" name="signup_cpassword" required />
          </div>
          <input type="submit" class="btn" name="signup" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
          Photo Enthuasists, Please, Click the Sign Up button
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="images/sign/undraw_product_photography_91i2 (1).svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            Photo Enthuasists, Please, Click the Sign In button
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="images/sign/undraw_moments_0y20.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <script src="app.js"></script>
</body>

</html>