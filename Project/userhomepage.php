<?php
include 'backendheader.php';
$image="";
if(isset($_POST['savepost'])){
    $posttext = $_POST['posttext'];
    $user = $_SESSION["id"]; 
    date_default_timezone_set("Asia/Dhaka"); 
    $date = date("d M Y");
    if(isset($_FILES['image'])){
        $image = rand(1111111,9999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'image/'.$image);
    }
    
    $sql = "INSERT INTO `post`(`userid`,`userimg`, `description`,`post_date`) VALUES ('$user','$image','$posttext','$date')";
    $result = mysqli_query($conn, $sql) or die("sql failed");
    header("Location:userhomepage.php");
}
?>

                <!-- main  -->
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <form action="search.php" method="GET">
                            <div class="form-group d-flex">
                                <input type="text" name="search" placeholder="Search Here...." class="form-control">
                                <button class="btn btn-success">Search</button>
                            </div>
                        </form>
                        <form  method="POST" enctype = "multipart/form-data">
                            <div class="form-group">
                                <label for="writepost">
                                    <h5>What's On Your Mind</h5>
                                </label>
                                <textarea class="form-control" id="writepost" placeholder="write something..."
                                    rows="5" required name="posttext"></textarea>
                                <!-- ৫টা বাক্যের সমান জায়গা নিবে।  -->
                            </div>
                            <input type="file" name="image" required><br><br>
                            <button class="btn btn-success" name="savepost">Submit</button>
                        </form>
                        <hr>
                    </div>
                    <?php
                            $sql1 = "SELECT * FROM `post` JOIN users ON post.userid=users.id ORDER BY post.post_id DESC";
                            $result1 = mysqli_query($conn, $sql1) or die("sql1 failed");                        
                     
                           while($row = mysqli_fetch_assoc($result1)) { ?>
                    <div class="col-md-3" >
                        <div class="card">
                            <img src="image/<?php echo $row['userimg']; ?>" class="card-img-top w-100 image_post" alt="...">
                            <div class="card-body">
                            <small><?php echo $row['post_date']; ?></small>
                                <h5 class="card-title mt-2"><?php echo $row['full_name']; ?></h5>
                                
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <i <?php if (userLiked($row['post_id'])): ?>
                                    class="fa fa-thumbs-up like-btn"
                                <?php else: ?>
                                    class="fa fa-thumbs-o-up like-btn"
                                <?php endif ?>
                                data-id="<?php echo $row['post_id']; ?>" aria-hidden="true"></i>(<span class="likes"><?php echo getLikes($row['post_id']); ?></span>) 
                                <i 
                                <?php if (userDisliked($row['post_id'])): ?>
                                    class="fa fa-thumbs-down dislike-btn"
                                <?php else: ?>
                                    class="fa fa-thumbs-o-down dislike-btn"
                                <?php endif ?>
                                 data-id="<?php echo $row['post_id']; ?>" aria-hidden="true"></i>(<span class="dislikes"><?php echo getDislikes($row['post_id']); ?></span>) 
                            </div>
                            <div class="d-md-flex justify-content-between">
                                <a href="comments.php?id=<?php echo $row['post_id']; ?>" class="text-success pl-3">Comments</a>
                                <?php 
                                if($row['userid'] == $_SESSION["id"] || $_SESSION["role"] == '1'){ ?>
                                   <a href="deletepost.php?id=<?php echo $row['post_id']; ?>" class="text-success pl-3">Delete</a>
                                   <?php } ?>                               
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- main -->
<?php include 'footer.php';?>