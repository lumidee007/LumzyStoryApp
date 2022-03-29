<?php 
 session_start()
?>

<?php 
    include_once './templates/header.php';
    
?>

<h1 style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Search result for <?php 
$value = $_POST['search_value'];
echo ucfirst($value); 
?></h1>

<main>
       <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col-12 text-center bg-success">
                </div>
                    <?php 

                        if(isset($_POST['search_submit'])){

                            include_once './dbConnect.php';

                            $searchValue = mysqli_real_escape_string($db, $_POST['search_value']);

                            $sql = "SELECT * FROM contentUploads WHERE content_category LIKE '%$searchValue%'   OR content_city LIKE '%$searchValue%'  OR content_username LIKE '%$searchValue%'";

                            $result = mysqli_query($db, $sql);

                            $queryResult = mysqli_num_rows($result);


                            if($queryResult > 0){
                                while($row = mysqli_fetch_assoc($result)) {
                                    $home_user = ucfirst($row["content_username"]);
                                    echo "
                                    <div class='col'>
                                        <div class='card h-100'>
                                            <img src='./assets/uploads/$row[content_fileName]' class='card-img-top img-thumbnail' alt='...' style='height: 350px; '> 
                                            <p class='.upload-info' style='color: darkblue; font-size: 14px; margin-left: 2px; '><i class='fas fa-user'> Posted by: $home_user, <span style='margin-left:auto'>$row[content_uploadDate]</span></i> </p>
                                            <div class='card-body'>
                                                <h5 class='card-title'>$row[content_name]</h5>
                                                <p class='card-text'>$row[content_desc]</p>
                                            </div>
                                            <div class='card-footer d-flex justify-content-between'>
                                                <div><span>City:</span> <span>$row[content_city]</span></div>
                                                <div><span>Category:</span> <span>$row[content_category]</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                }
                            } else {
                                echo "No result found";
                            }
                        }
                    ?>     
            </div>
       </div>
   </main>