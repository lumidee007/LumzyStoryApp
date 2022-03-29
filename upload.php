<?php 
 session_start();
?>

<?php 
    include_once './templates/header.php';
?>
   <section>
       <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col-12 text-center bg-success">
                </div>
                    <?php 
                        include ("./dbConnect.php");
                        $username = $_SESSION['username'];
                        $sql = "SELECT * FROM contentUploads WHERE content_username = '$username'";
                        $stmt = mysqli_stmt_init($db);

                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL statement failed!";
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            while($row = mysqli_fetch_assoc($result)){
                                $home_user = ucfirst($row["content_username"]);
                                $home_content_name = ucfirst($row["content_name"]);
                                $home_content_desc = ucfirst($row["content_desc"]);
                                echo "
                                    <div class='col' id='$row[content_id]'>
                                        <div class='card h-100'>
                                            <img src='./assets/uploads/$row[content_fileName]' class='card-img-top img-thumbnail' alt='...' style='height: 350px; '> 
                                            <p class='.upload-info' style='color: darkblue; font-size: 14px; margin-left: 2px; '><i class='fas fa-user'> Posted by: $home_user, <span style='margin-left:auto'>$row[content_uploadDate]</span></i> </p>
                                            <div class='card-body'>
                                                <h4 class='card-title'>$home_content_name</h4>
                                                <hr>
                                                <p class='card-text'>$home_content_desc</p>
                                            </div>
                                            <div class='card-footer d-flex justify-content-between'>
                                                <div><span>City:</span> <span>$row[content_city]</span></div>
                                                <div><span>Category:</span> <span>$row[content_category]</span></div>
                                                
                                                <button style='color:red;font-weight: bold; border: 1px solid red; border: none' name='delete' onClick = 'deletePost($row[content_id])'>X</button>
                                            </div>
                                        </div>
                                        </div>
                                " ; 
                            }
                        }
                    ?>     
            </div>
       </div>
   </section>

    <section id="contact" class="bg-secondary py-1 mt-3">
        <div class="container-lg">
           <div class="text-center mt-5">
               <h2>Share your experience</h2>
           </div>
           <div class="row justify-content-center my-5">
               <div class="col-lg-6">
               <form class="row g-3" method="POST" action="includes/upload-inc.php" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <label for="content_name" class="form-label">Content title</label>
                        <input type="text" name="content_name" class="form-control" id="content_name">
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <select name="city" class="form-select" aria-label="Default select example">
                                <option selected>...Choose...</option>
                                <option value="Aberdeen">Aberdeen</option>
                                <option value="Glasgow">Glasgow</option>
                                <option value="Dundee">Dundee</option>
                                <option value="Edinburgh">Edinburgh</option>
                                <option value="Inverness">Inverness</option>
                                <option value="Perth">Perth</option>
                                <option value="Stirling">Stirling</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Description:</label>
                        <div class="form-floating">
                            <textarea class="form-control" name="description" placeholder="Leave a comment here" id="description"></textarea>
                            <label for="floatingTextarea">Share your experience....</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" class="form-select" aria-label="Default select example">
                                <option value="" selected>...Choose...</option>
                                <option value="Hotel">Hotel</option>
                                <option value="Museum">Museum</option>
                                <option value="Amusement_park">Amusement park</option>
                                <option value="Beach">Beach</option>
                                <option value="Resort">Resort</option>
                                <option value="Castle">Castle</option>
                                <option value="Cinema">Cinema</option>
                                <option value="Resturant">Restaurant</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="img_name" class="form-label">Upload picture:</label>
                        <input type="file" name="file_name" class="form-control" id="img_name">
                    </div>
                    <div class="col-md-12 text-center" >
                        <button type="submit" name="upload" class="btn btn-primary" style="width: 50%;">Upload</button>
                    </div>
                </form>
               </div>
           </div>
        </div>
    </section>
    <script src="./delete.js"></script>
<?php 
    include_once './templates/footer.php';
?>
