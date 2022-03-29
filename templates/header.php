<?php 
 session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Story Application</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/344b115980.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../assets/styles/index.css">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light py-6 bg-dark color-light" style="padding-top: 30px; padding-bottom: 30px; color: white; font-weight: bolder; " id="nav-edit">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"  style="margin-right:30px; font-size: 20px;color: chartreuse;">Lumzy Story App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="color: white; font-size: 20px;">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php" style="color: white;">HOME</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="about.php" style="color: white;">ABOUT</a>
                </li>

                <?php 

                if(isset($_SESSION["username"])) {
                    $value = $_SESSION["username"];
                    $admin = $_SESSION["admin"] ? (($_SESSION["admin"])): null;
                    $content = $_SESSION["admin"] ? "ADMIN PAGE": "UPLOAD STORY";
                    $link = $_SESSION["admin"] ? "admin.php": "upload.php";

                    $User = ucfirst($value);
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='$link' style='color: white;'>$content</a>
                    </li>" ;
                    echo '<li class="nav-item">
                    <a class="nav-link" href="logout.php" style="color: white;">LOGOUT</a>
                    </li>';
                    echo "<li class='nav-item'>
                    <a class='nav-link' style='color: chartreuse;font-family: 'Times New Roman', Times, serif;'> Welcome, {$User} <span style='font-size:12px; color: red;'>$admin</span></a>
                    </li>";

                } else {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="signup.php" style="color: white;">SIGN UP</a>
                    </li>';
                    echo '<li class="nav-item">
                    <a class="nav-link" href="login.php" style="color: white;">LOGIN</a>
                    </li>';
                }   
                ?> 
            </ul>
            <form class="d-flex" action="./search.php" method="post">
                <input class="form-control me-2" name="search_value" type="search" placeholder="..Search by category.." aria-label="Search">
                <button class="btn btn-outline-success" name="search_submit" type="submit">Search</button>
            </form>
            
            </div>
            
        </div>
    </nav>
</header>
<div class="container" style="min-height: 100vh; position: relative;">