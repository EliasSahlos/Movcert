<?php
session_start();
require("include/config.php");
$query = mysqli_query($sql, "SELECT * FROM concerts");
$row = mysqli_fetch_all($query);
$concertID = array();
$concertTitle = array();
$concertGenre = array();
$concertDescription = array();
$concertImage = array();
$concertPrice = array();
$concertStartDate = array();
$concertEndDate = array();
$concertFrequency = array();
$concertStartTime = array();
$concertSeats = array();
$backgroundImage = array();
for ($i = 0; $i < sizeof($row); $i++) {
    $concertID[$i] = $row[$i][0];
    $concertTitle[$i] = $row[$i][1];
    $concertGenre[$i] = $row[$i][2];
    $concertDescription[$i] = $row[$i][3];
    $concertImage[$i] = $row[$i][4];
    $concertPrice[$i] = $row[$i][5];
    $concertStartDate[$i] = $row[$i][6];
    $concertEndDate[$i] = $row[$i][7];
    $concertFrequency[$i] = $row[$i][8];
    $concertStartTime[$i] = $row[$i][9];
    $concertSeats[$i] = $row[$i][10];
    $backgroundImage = $row[$i][11];
}

if(!empty($_GET["genre"])){
    $genre = $_GET["genre"];
} 
else {
    $genre = '';
}

if(!empty($_GET["date"])){
    $startingDate = $_GET["date"];
} else {
    date_default_timezone_set('Europe/Athens');
    $startingDate = date('m/d/Y h:i:s a', time());
}

if(!empty($_GET["price-low"])){
    $priceLow = $_GET["price-low"];
} else {
    $priceLow = "0";
}

if (!empty($_GET["price-high"])) {
    $priceHigh = $_GET["price-high"];
} else {
    $priceHigh = "10000";
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Movcert - Concerts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css"
        href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/fancybox.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header class="site-header js-site-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="index.php">Movcert</a></div>
                <div class="col-6 col-lg-8">


                    <div class="site-menu-toggle js-site-menu-toggle" data-aos="fade">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <!-- END menu-toggle -->

                    <div class="site-navbar js-site-navbar">
                        <nav role="navigation">
                            <div class="container">
                                <div class="row full-height align-items-center">
                                    <div class="col-md-6 mx-auto">
                                        <ul class="list-unstyled menu">
                                            <li class="active"><a href="index.php">Home</a></li>
                                            <li><a href="concerts.php">Concerts</a></li>
                                            <li><a href="movies.php">Movies</a></li>
                                            <?php
                                                if(isset($_SESSION["id"])){
                                                    echo "<li><a href='../admin-panel/admin.php'>Admin Panel</a></li>";
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- END head -->

    <section class="site-hero inner-page overlay" style="background-image: url(images/finalcollage.png)"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">Concerts</h1>
                </div>
            </div>
        </div>

        <a class="mouse smoothscroll" href="#next">
            <div class="mouse-icon">
                <span class="mouse-wheel"></span>
            </div>
        </a>
    </section>
    <!-- END section -->

    <section class="section pb-4">
        <div class="container">

            <div class="row check-availabilty" id="next">
                <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

                    <form action="#" method="get">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                                <label for="genre" class="font-weight-bold text-black">Music Genre</label>
                                <div class="field-icon-wrap">
                                    <input type="text" id="genre" name="genre" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                                <label for="date" class="font-weight-bold text-black">Check Out</label>
                                <div class="field-icon-wrap">
                                    <input type="date" id="date" name="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="price-range-low" class="font-weight-bold text-black">Price - Low</label>
                                        <div class="field-icon-wrap">
                                            <input type="text" name="price-low" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="price-range-high" class="font-weight-bold text-black">Price - High</label>
                                        <div class="field-icon-wrap">
                                            <input type="text" name="price-high" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 align-self-end">
                                <button type="submit" class="btn btn-primary btn-block text-white">Set Filters</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </section>


    <section class="section">
        <div class="container">

            <div class="row">
                <?php
                $query = mysqli_query($sql, "SELECT * 
                FROM concerts
                WHERE genre LIKE '%" . $genre . "%'
                AND begin_date >= '".$startingDate."'
                AND price >='".$priceLow."'
                AND price <= '".$priceHigh."'
                ");
                $row = mysqli_fetch_all($query);
                $concertID = array();
                $concertTitle = array();
                $concertGenre = array();
                $concertDescription = array();
                $concertImage = array();
                $concertPrice = array();
                $concertStartDate = array();
                $concertEndDate = array();
                $concertFrequency = array();
                $concertStartTime = array();
                $concertSeats = array();
                $backgroundImage = array();
                for ($i = 0; $i < sizeof($row); $i++) {
                    $concertID[$i] = $row[$i][0];
                    $concertTitle[$i] = $row[$i][1];
                    $concertGenre[$i] = $row[$i][2];
                    $concertDescription[$i] = $row[$i][3];
                    $concertImage[$i] = $row[$i][4];
                    $concertPrice[$i] = $row[$i][5];
                    $concertStartDate[$i] = $row[$i][6];
                    $concertEndDate[$i] = $row[$i][7];
                    $concertFrequency[$i] = $row[$i][8];
                    $concertStartTime[$i] = $row[$i][9];
                    $concertSeats[$i] = $row[$i][10];
                    $backgroundImage = $row[$i][11];
                }
                for ($i = 0; $i < sizeof($row); $i++) {
                ?>
                <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
                    <a href="concerts-sp.php?id=<?php echo($concertID[$i]) ?>" class="room">
                        <figure class="img-wrap">
                            <?php echo '<img src="' . $concertImage[$i] . '" alt="Free website template" width="400px" height="400px">' ?>
                        </figure>
                        <div class="p-3 text-center room-info">
                            <?php echo '<h2>' . $concertTitle[$i] . '</h2>' ?>
                            <?php echo ' <span class="text-uppercase letter-spacing-1">' . $concertGenre[$i] . '</span>' ?>
                        </div>
                    </a>
                </div>
                <?php } ?>

            </div>
        </div>
    </section>

   
    <footer class="bg-dark text-center text-lg-start">
        <div class="text-center p-3" style="background-color: #1A1A1A">
            Made With &nbsp; <i class="fa fa-heart"></i> &nbsp; By Alexandros and Elias
        </div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>