<?php
$showError="false";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        // <!----------------------------------------------- [Connect DataBase] ----------------------------------------------------------------->
        include "_dbconnect.php"; 
        $user_email = $_POST['signupEmail'];  // 'signupEmail'--> ya form ma jo name  diya ho ga wo chk kra ga
        $userpsw=$_POST['singnupPassword'];
        $usercpsw=$_POST['singnupCpassword'];

        // chk weather this email exists
        $existsql= "select * from `users` where user_email='$user_email'";
        $result = mysqli_query($conn,$existsql);
        $numRows = mysqli_num_rows($result);
                    if($numRows>0){
                        $showError="Email already in use";
                        }

                        else{
                                if($userpsw==$usercpsw){
                                    $hash =password_hash($userpsw, PASSWORD_DEFAULT);
                                    $sql="INSERT INTO `users` ( `user_email`, `user_pass`, `datetime`)
                                     VALUES ( '$user_email', '$hash', current_timestamp())";
                                    $result = mysqli_query($conn,$sql);
                                        if($result){
                                            $showAlert= true;
                                            header("Location:/47_forum_php_codewithharry/index.php?signupsuccess=true");
                                            exit();
                                            }
                                    }
                                    
                                    else{
                                        $showError="Passwords do not match";
                                    }
                        }


                header("Location:/47_forum_php_codewithharry/index.php?signupsuccess=false&error=$showError");
    }



?>