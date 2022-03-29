
<?php
session_start();
?>

<?php 
    include_once './templates/header.php';
?>
    <div class="container" >
    <section id="contact">
        <div class="container-lg">
           <div class="text-center mt-5">
               <h2>Login to access your account.</h2>
           </div> 
           <div class="row justify-content-center my-5">
                <div class="col-lg-6">
                <?php 
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "emptyinput"){
                                echo "<p style='color:red; text-align:center;'>Fill in all fields!</p>";
                            } else if ($_GET["error"] == "wronglogindetails"){ 
                                echo "<p style='color:red; text-align:center;'>Wrong login details!</p>"; 
                            }
                        }
                ?> 

                    <form action="includes/signin-inc.php"  method="POST" >
                        <label for="username" class="form-label">Username:</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill text-secondary"></i>
                            </span>
                            <input type="text" id="username" name="username" class="form-control" placeholder="e.g. Stewart" />
                        </div>

                        <label for="pwd" class="form-label">Password:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock text-secondary"></i>
                            </span>
                            <input type="password" name="pwd" id="pwd" class="form-control"  />
                        </div class="text-center">
                        <button type="submit" name="login" class="btn btn-secondary">Login</button>
                        </div>
                    </form>
                </div>
           </div>
        </div>
    </section>
    </div>
    



<?php 
    include_once './templates/footer.php';
?>
