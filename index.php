<?php 
 session_start();
?>

<?php 
    include_once './templates/header.php';
?>
   <main>
       <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col-12 text-center bg-success">
                </div>
                    <?php 
                        include ("./dbConnect.php");
                        $sql = "SELECT * FROM contentUploads ORDER BY content_position DESC";
                        $stmt = mysqli_stmt_init($db);

                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL statement failed___mide!";
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            while($row = mysqli_fetch_assoc($result)){

                                    $home_user = ucfirst($row["content_username"]);
                                    $home_content_name = ucfirst($row["content_name"]);
                                    $home_content_desc = ucfirst($row["content_desc"]);
                                echo "
                                    <div class='col'>
                                        <div class='card h-100'>
                                            <img src='./assets/uploads/$row[content_fileName]' class='card-img-top img-thumbnail' alt='...' style='height: 350px;'> 
                                            <p class='.upload-info' style='color: darkblue; font-size: 14px; margin-left: 2px; '><i class='fas fa-user'> Posted by: $home_user, <span style='margin-left:auto'>$row[content_uploadDate]</span></i> </p>
                                            <div class='card-body'>
                                                <h4 class='card-title'>$home_content_name </h4>
                                                <hr>
                                                <p class='card-text'>$home_content_desc</p>
                                            </div>
                                            <div class='card-footer d-flex justify-content-between'>
                                                <div><span>City:</span> <span>$row[content_city]</span></div>
                                                <div><span>Category:</span> <span>$row[content_category]</span></div>
                                            </div>
                                        </div>
                                        </div>
                                " ; 
                            }
                        }
                    ?>     
            </div>
       </div>
   </main>
   
<?php 
    include_once './templates/footer.php';
?>
