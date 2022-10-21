<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
    .unsplashimg {
        max-height: 400px;
    }

    .ques {
        min-height: 400px;
    }
    h1 {
  color: white;
  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
}
    </style>
    <title>Welcome - iDiscuss - Forum side </title>
</head>

<body>
<?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>
    
    <?php
    // Get On Card welcome To form
       $id = $_GET['threadid'];
         $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
         $result = mysqli_query($conn,$sql);
        //  $noResult = true; 
         while($row = mysqli_fetch_assoc($result)){
            // $noResult = false;
           $title = $row["thread_title"];
           $desc = $row['thread_desc'];

        //    64-Saving PHP Website From a Potential XSS Attack _ PHP Tutorial #64
           $thread_user_id = $row['thread_user_id'];
           $sql2 = "SELECT user_email FROM `users` where user_id = '$thread_user_id'";
           $result2 = mysqli_query($conn, $sql2);
           $row2 = mysqli_fetch_assoc($result2);
           $posted_by = $row2['user_email'];
        

        } 
          
 ?>

<!-- 58 POST REQUEST ON PAGE Detectin type method in php -->
<!-- Addig Comment Threads -->
<?php
    $showAlert = false;
     $method = $_SERVER['REQUEST_METHOD'];
     if($method == 'POST'){
        // Insert into thread into db
        $comment = $_POST['comment'];
        $comment  = str_replace("<", "&lt;", $comment);
        $comment  = str_replace(">", "&gt;", $comment);
        $user_id = $_POST['user_id'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`)
         VALUES ('$comment', '$id', '$user_id', current_timestamp());";
         $result = mysqli_query($conn, $sql);
         $showAlert = true;
         if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Thread has been success fully insertd.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
         }

     }
    ?>
    <!--JumboTrouns  -->
    <div class="container my-4">
        <div class="jumbotron">
            <!--    GEtT on index  -->
            <h1 class="display-4">Welcome to <?php echo $title;?> Forum</h1>
            <p class="lead"><?php echo $desc?> </p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <!-- <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a> -->
            <p>Posted by -><em> <?php echo $posted_by;?></em></p>
            </p>
        </div>
    </div>

    <!-- Add Form Registration Posted On website -->
    <!-- 57 Creating database Store commnt in database -->
    <!-- // 62-Restricting Posting and Commenting Activities to Logged in Users Only _ PHP Tutorial #62 -->
    <?php
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<div class="container">
            <h1 class="py-2">Post Comment</h1>
            <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Type your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    <input type="hidden" name="user_id" value="'.$_SESSION["user_id"].'">
                </div>
                <button type="submit" class="btn btn-success">Post Comment</button>
            </form>
            </div>';
     }
    //  Jub Loged in na hoto yah show krwady ga
     else{
        echo '
        <div class="container">

            <h1 class="py-2">Post Comment</h1>
            <p class="lead">You are not Logged in to Post Comments</p>
        </div>
        '; 
     }
?>

    <div class="container ">
        <!-- Data Insert In Threads Parts -->
        <h1 class="py-2">Discussion</h1>

        <!-- 57 Creating database Store commnt in database -->
        <?php 
    $id = $_GET['threadid'];
         $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
         $result = mysqli_query($conn,$sql);
         $noResult = true;
         while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row["comment_id"];
           $content = $row["comment_content"];
           $comment_time = $row['comment_time']; 
        //    63-Adding User Email with Comments and Posts _ PHP Tutorial #63
           $comment_by = $row['comment_by'];
           $sql2 = "SELECT user_email FROM `users` where user_id = '$comment_by'";
           $result2 = mysqli_query($conn, $sql2);
           $row2 = mysqli_fetch_assoc($result2);
       
    
            echo '<div class="media my-3">
            <img class="mr-3" src="img/userdefualtimg.png" width="34px" alt="Error">
            <div class="media-body">
            
            <p class="font-weight-bold my-0">Asked '.$row2['user_email'].' at'.$comment_time.'</p>
            '.$content.'
            </div>
            </div>';
}      
   // Use A Jumbo Trouns
// echo var_dump($noResult);
if($noResult){
    echo '<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <p class="display-4">No Comments Found</p>
      <p class="lead-2">Be the first person to  ask a question.</p>
    </div>
  </div>';
}  
 ?>
    </div>

    <?php include 'partials/_footer.php';?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>