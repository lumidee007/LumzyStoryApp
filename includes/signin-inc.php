

<?php 

if (IsSet($_POST["login"])){

    $username = $_POST["username"] ;
    $pwd = $_POST["pwd"] ;

    include '../dbConnect.php';




    if(checkInputFields($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput"); 
        exit();
    }

    loginUser($db,$username, $pwd);

} else {
    header("location: ../login.php"); 
    exit();
}
   

    function checkInputFields($username, $pwd){
        $result = false;
        if( empty($username) || empty($pwd)){
            $result = true;
        }
        return $result;
    }

    // Defined loginusers
    function loginUser($db,$username, $pwd){
        $usernameExist = userExist($db,$username, $username);

        if($usernameExist === false) {
            header("location: ../login.php?error=wronglogindetails");
            exit();
        }
        
        $encryptedPassword = $usernameExist["usersPwd"];

        $passwordCheck = password_verify($pwd, $encryptedPassword);

        if($passwordCheck === false) {
            header("location: ../login.php?error=wrongpassword");
            exit();
        } elseif($passwordCheck === true) {
            session_start();
            $_SESSION['username'] = $usernameExist["usersUid"];
            
     

            if($_SESSION['username'] == "lumzy"){
                $_SESSION['admin'] = "Admin";
                header("location: ../admin.php");

            } else {
                header("location: ../index.php");
                exit();  
            }
            
        }
    
    }

    // Check if user exist
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
?>


