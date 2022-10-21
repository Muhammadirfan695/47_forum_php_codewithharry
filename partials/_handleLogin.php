
<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    $sql = "Select * from users where user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['useremail'] = $email;
            echo "logged in". $email;
        } 
        // else{
        //     echo "invalid login";
        // }
        header("Location: /47_forum_php_codewithharry/index.php");  
    }
    // Ager koi glt entry krta hai to is page prrediirect kry  
    header("Location: /47_forum_php_codewithharry/index.php");  
}

?>