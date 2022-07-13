<?php
include 'backendheader.php';

 $postid = $_GET['id'];
 $sql = "SELECT * FROM `post` JOIN users ON post.userid=users.id WHERE post_id =  $postid";
$result=  mysqli_query($conn, $sql) or die("sql1 failed");
?>
                <!-- main  -->
                <div class="row">
                    <div class="col-md-6 offset-md-1">
                        <!-- offset মানে বাম থেকে কত কলাম বাদ যাবে বা সামনে যাবে -->
                        <?php
                        if(mysqli_num_rows($result)>0){   
                     while($row = mysqli_fetch_assoc($result)) { ?>
                      <div class="card">
                            <img src="image/<?php echo $row['userimg']; ?>" class="card-img-top w-100" alt="...">
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
                               
                                <?php 
                                if($row['userid'] == $_SESSION["id"] || $_SESSION["role"] == '1'){ ?>
                                   <a href="deletepost.php?id=<?php echo $row['post_id']; ?>" class="text-success pl-3">Delete</a>
                                   <?php } ?>                               
                            </div>
                           
                        </div>
                        
                        <?php } ?>
                    <?php } ?>
                    <?php
                        if(isset($_POST['add_comment'])){
                            $comments = $_POST['comments'];
                            $user = $_SESSION["id"];                             
                            $sql1 = "INSERT INTO `comments`(`comments`, `userid`,`post_id`) VALUES ('$comments','$user','$postid')";
                            $result1 = mysqli_query($conn, $sql1) or die("sql failed");
                            
                        }
                        ?>
                    <form class="my-3" method="POST">
                            <div class="form-group">                            
                            <textarea class="form-control" rows="3" placeholder="Add Comment..." name="comments" required></textarea>                               
                            </div>                           
                            <button type="submit" class="btn btn-success" name="add_comment">Add Comment</button>
                            </form>
                    </div>
                    <div class="col-md-5 border mt-3">
                        <h5>All Comments:</h5>
                    <?php
                     $sql2 = "SELECT * FROM `comments` JOIN users ON comments.userid=users.id JOIN post ON comments.post_id=post.post_id WHERE post.post_id = '$postid' ORDER BY comment_id DESC";
                     $result2=  mysqli_query($conn, $sql2) or die("sql1 failed");
                    if(mysqli_num_rows($result2)>0){   
                     while($row2 = mysqli_fetch_assoc($result2)) { ?>
                        <div class="media shadow mt-3">
                        <?php 
                            if($row2['profileimage']){ ?>
                                <img src="image/<?php echo $row2['profileimage']; ?>" class="mr-3 w-25" alt="...">
                        <?php  
                        }else{ ?>
                            <img src="images/profile.png" class="mr-3 w-25" alt="...">
                        <?php 
                        }
                        ?>
                            
                            <div class="media-body">
                                <h5 class="mt-0"><?php echo $row2['full_name']; ?></h5>
                                <p><?php echo $row2['comments']; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    <?php } 
                    else{
                        echo"<h4>No commnets...</h4>";
                    }
                    ?>
                    </div>
                </div>
                <!-- main -->
                <?php include 'footer.php';?>