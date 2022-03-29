<?php 
    include_once './templates/header.php';
?>

    <section id="contact">
        <div class="container-lg">
           <div class="text-center mt-5">
               <h2>Create account</h2>
           </div>
           <?php 
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "emptyinput"){
                                echo "<p style='color:red; text-align:center;'>Fill in all fields!</p>";
                            } else if ($_GET["error"] == "invalidname"){ 
                                echo "<p style='color:red; text-align:center;'>Choose a proper name!</p>"; 
                            }
                            else if ($_GET["error"] == "invalidemail"){
                                echo "<p style='color:red; text-align:center;'>Choose a valid email!</p>"; 
                            }
                            else if ($_GET["error"] == "passwordnotsame"){
                                echo "<p style='color:red; text-align:center;'>Password doesn't match!</p>"; 
                            }
                            else if ($_GET["error"] == "stmtfailed"){
                                echo "<p style='color:red; text-align:center;'>Something went wrong!</p>"; 
                            }
                            else if ($_GET["error"] == "usernamenotavailable"){
                                echo "<p style='color:red; text-align:center;'>Username not available!</p>"; 
                            }
                            else if ($_GET["error"] == "invalidusername"){
                                echo "<p style='color:red; text-align:center;'>Choose a proper username!</p>"; 
                            }
                            else if ($_GET["error"] == "none"){
                                echo "<p style='color:green; text-align:center;'>Account created succesfully!</p>"; 
                            }
                        }
            ?> 
           <div class="row justify-content-center my-5">
                <div class="col-lg-6">
                    <form action="includes/signup-inc.php"  method="POST">
                        <label for="name" class="form-label">Full name:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill text-secondary"></i>
                            </span>
                            <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Oluwafemi" />
                        </div>
                        <label for="email" class="form-label">Email address:</label>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill text-secondary"></i>
                            </span>
                            <input type="text" id="email" name="email" class="form-control" placeholder="e.g. example@example.com" />
                        </div>
                        <label for="username" class="form-label">Username:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill text-secondary"></i>
                            </span>
                            <input type="text" id="username" name="username" class="form-control" placeholder="e.g. famoochi" />
                        </div>

                        <label for="pwd" class="form-label">Password:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock text-secondary"></i>
                            </span>
                            <input type="password" id="pwd" name="pwd" class="form-control"  />
                        </div class="text-center">

                        <label for="pwdRepeat" class="form-label">Repeat password:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock text-secondary"></i>
                            </span>
                            <input type="password" id="pwdRepeat" name="pwdRepeat" class="form-control"  />
                        </div class="text-center">
                        <div class="mb-4 text-center">
                        <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                    
                </div>
           </div>
        </div>
    </section>
<?php 
    include_once './templates/footer.php';
?>
