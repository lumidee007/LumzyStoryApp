<?php 
if (IsSet($_POST["submit"])){


    $name = $_POST["name"] ;
    $email = $_POST["email"] ;
    $username = $_POST["username"] ;
    $pwd = $_POST["pwd"] ;
    $pwdRepeat = $_POST["pwdRepeat"] ;


    include '../dbConnect.php';


    if(checkErrors($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        
        header("location: ../signup.php?error=emptyinput"); 
        exit();
    }

    if(nameCheck($name) !== false) {
        header("location: ../signup.php?error=invalidname"); 
        exit();
    }

    if(usernameCheck($username) !== false) {
        header("location: ../signup.php?error=invalidusername"); 
        exit();
    }

    if(emailCheck($email) !== false) {
        header("location: ../signup.php?error=invalidemail"); 
        exit();
    }

    if(passwordMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=passwordnotsame"); 
        exit();
    }

    if(userExist($db,$username,$email) !== false){
        header("location: ../signup.php?error=usernamenotavailable"); 
        exit();
    }


    createUserAccount($db, $name, $email, $username, $pwd);


} else {
    header("location: ../signup.php");
}



// checking for error handling
function checkErrors($name, $email, $username, $pwd, $pwdRepeat){
    $result = false;
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
        $result = true;
    }
    return $result;
}


function nameCheck($name){
    $result = false;
    if(!preg_match("/^([a-zA-Z' ]+)$/", $name)){
        $result = true;
    }
    return $result;
}


function usernameCheck($username){
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    }
    return $result;
}


function emailCheck($email){
    $result = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    } 
    return $result;
}

function passwordMatch($pwd, $pwdRepeat){
    $result = false;
    if($pwd !== $pwdRepeat){
        $result = true;
    } 
    return $result;
}



function userExist($db, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ? ;";

    $stmt = mysqli_stmt_init($db);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed"); 
        exit(); 
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else {
       $result = false;
       return $result;
    }

   mysqli_stmt_close($stmt);
}



function createUserAccount($db, $name, $email, $username, $pwd){

    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUE (?,?,?,?);";

    $stmt = mysqli_stmt_init($db);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed"); 
        exit(); 
    }

    $encryptedPassword = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $encryptedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none"); 
    exit();
}

?>