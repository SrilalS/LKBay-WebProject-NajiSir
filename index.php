<?php
// Start the session
session_start();
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - LKBay.lk</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/Password-Strenght-Checker---Ambrodu-1.css">
    <link rel="stylesheet" href="assets/css/Password-Strenght-Checker---Ambrodu.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
</head>


<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#">LKBay.lk</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
           
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="catalog.php">All Products</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="cart.php"><?php
                    @$pre = $_SESSION["CART"];
                    @$pre = explode(";",$pre);
                    @$pre = count($pre)-1;
                    echo "My Cart ($pre)";
                    ?>
                    </a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="account.php">Account</a></li>
                </ul>
                

            </div>
        </div>
    </nav>
    <main class="page landing-page bg-light">
        <section class="clean-block slider dark" style="padding-bottom: 10px;">
            <div class="container">
                <div class="text-center block-heading" style="margin-bottom: 10px;">
                    <h2 class="text-info" style="margin-bottom: 10px;">Welcome to LKBay!</h2>
                    <p>Srilankas No. 1 Online Shoping Site where you can buy with confidence!</p>
                </div>
                <div class="carousel slide shadow-lg" data-ride="carousel" id="carousel-1">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"><img class="rounded w-100 d-block border" src="assets/img/scenery/1.jpg" alt="Slide Image" style="height: 400px;" height="400px"></div>
                        <div class="carousel-item"><img class="rounded w-100 d-block border" src="assets/img/scenery/2.jpg" alt="Slide Image" style="height: 400px;" height="400px"></div>
                        <div class="carousel-item"><img class="rounded w-100 d-block border" src="assets/img/scenery/3.jpg" alt="Slide Image" style="height: 400px;" height="400px"></div>
                        <div class="carousel-item"><img class="rounded w-100 d-block border" src="assets/img/scenery/4.jpg" alt="Slide Image" style="height: 400px;" height="400px"></div>
                        <div class="carousel-item"><img class="rounded w-100 d-block border" src="assets/img/scenery/5.jpg" alt="Slide Image" style="height: 400px;" height="400px"></div>
                    </div>
                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button"
                            data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-1" data-slide-to="1"></li>
                        <li data-target="#carousel-1" data-slide-to="2"></li>
                        <li data-target="#carousel-1" data-slide-to="3"></li>
                        <li data-target="#carousel-1" data-slide-to="4"></li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading" style="padding-top: 20px;">
                    <h2 class="text-info">Featured Products</h2>
                    <p class="text-center">Best products from Best Sellers. Handpicked by our Editors.</p>
                </div>
                <div class="row justify-content-center">

                <?php

                //$lengthJ = file_get_contents('https://firestore.googleapis.com/v1/projects/lkbay-bd5eb/databases/(default)/documents/ITEMS/E/');
                //$length = json_decode($lengthJ,true);
                //$LEN = $length['fields']['ITMCNT']['stringValue'];
                for ($i=1; $i < 3; $i++) { 
                    
                    $url = 'https://firestore.googleapis.com/v1/projects/lkbay-bd5eb/databases/(default)/documents/ITEMS/ALL/ITEMS/';
                    $url .=$i;
                    $url .='/';
                    
                    $json = file_get_contents($url);
                    $JSONobj = json_decode($json,true);
                    $price = $JSONobj['fields']['P']['stringValue'];
                    $name = $JSONobj['fields']['N']['stringValue'];
                    $desc = $JSONobj['fields']['D']['stringValue'];
                    $company = $JSONobj['fields']['C']['stringValue'];
                    $urlX = $JSONobj['fields']['U']['stringValue'];
                    echo <<<ER
                    
                    <div class="col-12 col-md-6 col-lg-4 bg-white">
                        <div class="shadow clean-product-item">
                            <div class="image"><a href="./product.php?name=$name&desc=$desc&price=$price&img=$urlX&company=$company"><img class="img-fluid d-block mx-auto" src="$urlX" style="height:160px;width:160px"></a></div>
                            <div class="product-name"><a href="./product.php?name=$name&desc=$desc&price=$price&img=$i&company=$company">$name</a></div>
                            <div class="about">
                                <div class="price">
                                    <h3>$$price</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    ER;
                }
                    ?>
                </div>
            </div>
        </section>
    </main>
    <footer class="page-footer dark">
        <div class="footer-copyright">
            <p>© 2020 LKBay ltd.</p>
        </div>
    </footer>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
</body>
</html>