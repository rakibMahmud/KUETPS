<?php
include 'backendheader.php';
?>

                <!-- main  -->
                <div class="row mt-5">                    
                    <?php
                            $sql1 = "SELECT * FROM `post` JOIN users ON post.userid=users.id WHERE userid= {$_SESSION['id']} ORDER BY post.post_id DESC";
                            $result1 = mysqli_query($conn, $sql1) or die("sql1 failed");                        
                     
                           while($row = mysqli_fetch_assoc($result1)) { ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="image/<?php echo $row['userimg']; ?>" class="card-img-top w-100 image_post" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['full_name']; ?></h5>
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