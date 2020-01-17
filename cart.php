<?php
// Start the session
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>About Us - LKBay.lk</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#">LKBay.lk</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="catalog.php">All Products</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="cart.php">
                    <?php
                    
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
    <main class="page">
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Cart</h2>
                </div>
                <div class="row justify-content-around">
                    
                <div class="list-group shadow-lg">

                <?php

                if(isset($_POST['dmc'])) { 
                    $_SESSION["CART"]='';
                }
                
                @$pre = $_SESSION["CART"];
                @$pre = explode(";",$pre);
                //echo count($pre);
                //$pre = array_unique($pre);
                //echo count($pre);
                //print_r($pre);
                $total=0;

                if (count($pre) >1){
                    //echo count($pre);
                    for ($i=1; $i < count($pre); $i++) {

                        $name;
                        $company;
                        $price;
                        $desc;
        
                        $url = 'https://firestore.googleapis.com/v1/projects/lkbay-bd5eb/databases/(default)/documents/ITEMS/ALL/ITEMS/';
                        $url .=$pre[$i];
                        $url .='/';
    
                        $json = @file_get_contents($url);
                        $JSONobj = json_decode($json,true);
    
                        $price = $JSONobj['fields']['P']['stringValue'];
                        $desc = $JSONobj['fields']['D']['stringValue'];
                        $name = $JSONobj['fields']['N']['stringValue'];
                        $company = $JSONobj['fields']['C']['stringValue'];
                        $urlX = $JSONobj['fields']['U']['stringValue'];
    
                        $total = $total + (float)$price;
    
                        
    
                        echo <<< LIST
                        <div class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                            <h5 style='margin-right:512px'>$name</h5>
                            <h4 class="text-info">$$price</h4>
                        </div>
                            <p class="mb-1">$desc</p>
                        </div>
                        LIST;
                    }
    
    
                    ?>
    
                    <?php
    
                    echo "<h3 style='padding-top:16px; padding-left:16px'>Total Is: $$total</h3>";
                    echo '<input type="button" class="btn btn-lg btn-success" value="Checkout">';
                    echo '<br>';
                    echo <<<XM
                    <form method="post">
                        <input hidden type="text" name="dmc" value="dmc">
                        <input style='margin-left:365px' type="submit" class="btn btn-danger" value="Clear Cart">
                    </form>
                    XM;
                } else {
                    echo '<h2 class="text-info">No Items!</h2>';
                }
                
                
                ?>

                    

                </div>


                </div>
            </div>
        </section>
    </main>

    <footer style="margin-top:250px" class="page-footer dark">
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