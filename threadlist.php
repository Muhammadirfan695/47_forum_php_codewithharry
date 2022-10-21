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
       $id = $_GET['catid'];
         $sql = "SELECT * FROM `catagories` WHERE catagory_id=$id";
         $result = mysqli_query($conn,$sql);
         while($row = mysqli_fetch_assoc($result)){
            $catname = $row["catagory_name"];
           $carddesc = $row['catagory_description']; 
        }      
 ?>

    <!-- POST REQUEST ON PAGE Detectin type method in php -->
    <?php
    $showAlert = false;
     $method = $_SERVER['REQUEST_METHOD'];
     if($method == 'POST'){
        // Insert into thread into db

        // https://www.php.net/manual/en/function.str-replace.php
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
// Replace Str Script Etc
        $th_title  = str_replace("<", "&lt;", $th_title);
        $th_title  = str_replace(">", "&gt;", $th_title);

        $th_desc  = str_replace("<", "&lt;", $th_desc);
        $th_desc  = str_replace(">", "&gt;", $th_desc);


         $user_id1= $_POST['user_id'];
        $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`,
         `datetime`) VALUES ( '$th_title', '$th_desc', '$id', '$user_id1', current_timestamp())";
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

    <div class="container my-4">
        <div class="jumbotron">
            <!--    GEtT on index  -->
            <h1 class="display-4">Welcome to <?php echo $catname;?> Forum</h1>
            <p class="lead"><?php echo  $carddesc?> </p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>


    <!-- Add Form -->
    <h1 class ="py-2 text-center text-shadow">Start a Discussion</h1>
    <?php
    // 62-Restricting Posting and Commenting Activities to Logged in Users Only _ PHP Tutorial #62  
            if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
                echo '<div class="container">
                    
                        <form action="'. $_SERVER['REQUEST_URI'] .'"method ="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Problem Title</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">keep your title as short and crisp as possible
                                    .</small>
                            </div>
                            <input type="hidden" name="user_id" value="'.$_SESSION["user_id"].'">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Elaborate your concern</label>
                                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                </div> '; 
            }
    //  Jub Loged in na hoto yah show krwady ga
     else{
        echo '
        <div class="container">
            <h1 class="py-2">Start a Question</h1>
            <p class="lead">You are not Logged in</p>
        </div>
        ';
     }
?>

    <div class="container mb-5">
        <!-- Data Insert In Threads Parts -->
        <h1 class="py-2">Browser Questions</h1>
        <?php
    $id = $_GET['catid'];
         $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
         $result = mysqli_query($conn,$sql);
         $noResult = true;
         while($row = mysqli_fetch_assoc($result)){
            $noResult = false; 
            $id = $row['thread_id'];
           $title = $row['thread_title'];
           $desc = $row['thread_desc']; 
           $thread_time = $row['datetime'];

        //    63-Adding User Email with Comments and Posts _ PHP Tutorial #63
           $thread_user_id = $row['thread_user_id'];
           $sql2 = "SELECT user_email FROM `users` where user_id='$thread_user_id'";
           $result2 = mysqli_query($conn,$sql2);
           $row2 = mysqli_fetch_assoc($result2);
// exit();

echo '<div class="media my-3">
<img src="img/userdefualtimg.png" width="54px" class="mr-3" alt="...">
<div class="media-body">'.
 '<h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid=' . $id. '">'. $title . ' </a></h5>
    '. $desc . ' </div>'.'<div class="font-weight-bold my-0"> Asked by: '. $row2['user_email'] . ' at '. $thread_time. '</div>'.
'</div>';
            

} 

   if($noResult){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <p class="display-4">No Threads Found</p>
                  <p class="lead-2">Be the fist person to  ask a question.</p>
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