<?php
include 'backendheader.php';
if(isset($_GET['search'])){
  $search_term = $_GET['search'];
    $sql = "SELECT * FROM `post` JOIN users ON post.userid=users.id WHERE post.description LIKE '%{$search_term}%' OR users.full_name LIKE '%{$search_term}%'";
    $result = mysqli_query($conn, $sql) or die("sql failed");
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
                        <h5>Search: <?php echo $search_term ?></h5>                      
                    </div>
                    
                    <?php
                    if(mysqli_num_rows($result)>0){   
                     while($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="image/<?php echo $row['userimg']; ?>" class="card-img-top w-100" alt="...">
                            <div class="card-body">
                            <small><?php echo $row['post_date']; ?></small>
                                <h5 class="card-title mt-2"><?php echo $row['full_name']; ?></h5>
                                
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>(0) <i
                                    class="fa fa-thumbs-o-down ml-5" aria-hidden="true"></i>(0)
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
                    <?php } 
                    else{
                        echo"<h4>No search result found</h4>";
                    }
                    ?>
                </div>
                <!-- main -->
<?php include 'footer.php';?>