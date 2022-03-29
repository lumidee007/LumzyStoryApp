<?php 
 session_start()
?>

<?php 



if(isset($_POST["upload"])){

    $contentName = $_POST["content_name"];

    if(empty($_POST["content_name"])){

        $contentName = "Content upload";

    } else {
        $contentName = strtolower(str_replace(" ", "-",$contentName));
    }


    $contentCity = $_POST["city"];
    $contentDescription = $_POST["description"];
    $contentCategory = $_POST["category"];

    $contentUploadDate = $_POST["date"];
    $contentuserName = $_SESSION["username"];


    $file = $_FILES['file_name'];


    $contentFileName = $file['name'];
    $contentFileType = $file['type'];
    $contentFiletemp_name = $file['tmp_name'];
    $contentFileError = $file['error'];
    $contentFileSize = $file['size'];


    $fileExt = explode(".", $contentFileName);
    $fileMainExt = strtolower(end($fileExt));


    $fileAccepted = ['jpg', 'jpeg', 'png'];

    if(!in_array($fileMainExt, $fileAccepted )){
        echo "the required file type is jpg, jpeg or png.";
        exit();
    } else {
        if($contentFileError > 0) {
            echo 'file upload error';
            exit();
        } else {
            if ($contentFileSize > 800000000 ){
                echo "File size is too big.";
            } else {
                $imageFullName = $contentName . "." . uniqid("", true). "." . $fileMainExt;
                $contentDestination = '../assets/uploads/' .$imageFullName;

                include_once '../dbConnect.php';

                if(empty($contentName) || empty($contentCity) || empty($contentDescription) || empty($contentCategory) ||  empty($contentuserName) || empty($contentFileName)){
                    header("Location: ../upload.php?upload=empty");
                } else {
                    $sql = "SELECT * FROM contentUploads;";
                    $stmt = mysqli_stmt_init($db);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL statement failed!___seyi" ;
                        header("location: ../upload.php?error=stmtfailed"); 
                        exit(); 
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageposition = $rowCount + 1;

                        $sql = "INSERT INTO contentUploads (content_username, content_name, content_fileName, content_city, content_desc, content_category, content_position) VALUES (?,?,?,?,?,?,?);";

                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL statement failed!____pedro" ;
                        } else {
                            mysqli_stmt_bind_param($stmt, "sssssss", $contentuserName, $contentName, $imageFullName, $contentCity, $contentDescription, $contentCategory, $setImageposition);
                            mysqli_stmt_execute($stmt);


                            move_uploaded_file($contentFiletemp_name, $contentDestination);
                            

                            if($_SESSION["username"] == 'lumzy'){
                                header("Location: ../admin.php?upload=success");  
                            }
                            header("Location: ../upload.php?upload=success");
                        }
                    }
                }
            }
        }
        
    }

}




















?>