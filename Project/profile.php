<?php
include 'backendheader.php';
$image="";
if(isset($_POST['updateuser'])){   
    if(isset($_FILES['image'])){
        $image = rand(1111111,9999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'image/'.$image);
    }
    $sql = "UPDATE `users` SET `profileimage`= '$image' WHERE id= {$_SESSION['id']}";
    $result = mysqli_query($conn, $sql,) or die("sql failed");
    header("Location:profile.php");
}
?>

                <!-- main  -->
                <div class="row">
                    <div class="col-md-4 offset-md-4 mt-5">
                        <!-- offset বাম থেকে ৪ ঘর কলাম বাদ যাবে  -->
                        <h5 class="text-center">Upload Your Image</h5>
                        <form  method="POST" enctype = "multipart/form-data">
                                <?php                
                                $sql1 = "SELECT * FROM `users` WHERE id= {$_SESSION['id']}";
                                $result1 = mysqli_query($conn, $sql1,) or die("sql1 failed");
                                while($row = mysqli_fetch_assoc($result1)) { ?>
                                <?php 
                                if( $row['profileimage'] == NULL){?>
                                    <img src="images/new.png" class="w-100 mb-3" alt="">
                                <?php } ?> 

                                <?php 
                                if( $row['profileimage']){?>
                                    <img src="image/<?php echo $row['profileimage']; ?>" class="w-100 mb-3" alt="">
                                <?php } ?>  
                                <?php } ?>
                            
                           
                                                      
                           
                           
                            <input type="file" class="mb-3" name="image">
                            <button type="submit" class="btn btn-success" name="updateuser">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- main -->
                <?php include 'footer.php';?>