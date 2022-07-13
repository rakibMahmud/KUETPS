<?php
include 'backendheader.php'; 
$sql="SELECT * FROM `users` WHERE role = 2";
$result = mysqli_query($conn, $sql,) or die("sql failed");
?>

                <!-- main  -->
                <div class="row mt-5">
                    <div class="col-md-12">
                        <form action="">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control">
                                <button class="btn btn-success">Search</button>
                            </div>
                        </form>
                        <table class="table mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             while($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['full_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><a href="deleteuser.php?id=<?php echo $row['id']; ?>" class="text-success">Delete</a></td>
                                </tr>
                             <?php } ?>      
                              
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- main -->
                <?php include 'footer.php';?>