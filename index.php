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
        max-width: 2000px
    }
    h2 {
  color: white;
  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
}
    </style>
    <title>Welcome- iDiscuss - Forum side</title>
</head>

<body>
<?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>


    <!-- COmponent Crousel Slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="unsplashimg carousel-inner">
            <div class="carousel-item active">
                <img src="img/1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="unsplashimg carousel-item">
                <img src="img/2.jpg" class=" d-block w-100" alt="...">
            </div>
            <div class="unsplashimg carousel-item">
                <img src="img/4.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container my-4 ">
        <h2 class="text-center my-4"> iDiscuss Forums</h2>
        <div class="row my-4">

            <?php
// Fetch Query On _dbcoonect Database
        $sql = "SELECT * FROM `catagories`";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            // echo $row['catagory_id'];
            // echo $row['catagory_name'];

            //  Use for Loop Iterates in form card
            

            //Unsplash pictures 

            // Line no 79 <img class="card-img-top" src="https://source.unsplash.com/random/500×400/?'. $card.',coding"
            //     alt="Card image cap"
            $id = $row['catagory_id'];
            $card = $row['catagory_name'];
            $desc = $row['catagory_description'];
           echo '<div class="col-md-4 my-2">
                <div class="card" style="width: 18rem;">
                    <!-- Source code images https://awik.io/generate-random-images-unsplash-without-using-api/ -->
        
                    <img class="card-img-top" src="img/card-'. $id . '.jpg"
                    alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$card.'</a></h5>
                        <p class="card-text">'.substr($desc, 0 ,100 ).'....</p>
                        <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">view Threads</a>
                    </div>
                </div>
            </div>';
        }
        ?>
        </div>
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