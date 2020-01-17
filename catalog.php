<?php
// Start the session
session_start();
?>
<html>

<head>
    <script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-storage.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Catalog - LKBay.lk</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#">LKBay.lk</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php">Home</a></li>
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
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">All Products</h2>
                    
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="products ">
                                <div class="row no-gutters">

                                <?php

                                for ($i=1; $i < 1000; $i++) { 
                                    $name;
                                    $company;
                                    $price;
                                    $desc;
    
                                    $url = 'https://firestore.googleapis.com/v1/projects/lkbay-bd5eb/databases/(default)/documents/ITEMS/ALL/ITEMS/';
                                    $url .=$i;
                                    $url .='/';

                                    
                                    
                        
                                    $json = @file_get_contents($url);
                                    $JSONobj = json_decode($json,true);

                                    if ($JSONobj == null){
                                        break;
                                    }


                                    if ($JSONobj !== null && $JSONobj['fields']['DEL']['stringValue']=='0'){
                                        $price = $JSONobj['fields']['P']['stringValue'];
                                        $desc = $JSONobj['fields']['D']['stringValue'];
                                        $name = $JSONobj['fields']['N']['stringValue'];
                                        $company = $JSONobj['fields']['C']['stringValue'];
                                        $urlX = $JSONobj['fields']['U']['stringValue'];

                                        //$imgUrl = 'https://firebasestorage.googleapis.com/v0/b/lkbay-bd5eb.appspot.com/o/PIMG%2F';
                                        //$imgname = $i;
                                        //$adder = '.jpg?alt=media&token=3cdf607a-9ec7-4f82-8d5b-a5ccf3dcd40f';

                                        //$imgUrl = $imgUrl.$imgname.$adder;
    
    
                                        echo <<< PRD
                                        
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="clean-product-item">
                                                    <div class="image"><a href="./product.php?name=$name&desc=$desc&price=$price&img=$i&company=$company" ty ><img class="img-fluid d-block mx-auto" src="$urlX" style="height:160px;width:160px"></a></div>
                                                    <div class="product-name">
                                                    <a href="./product.php?name=$name&desc=$desc&price=$price&img=$urlX&company=$company">$name</a>
                                                    </div>
                                                    <div class="about">
                                                        <div class="price">
                                                            <h3>$$price</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        PRD;
                                    }


                                    
                                }

                               
                                ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    

    <footer class="page-footer dark ">
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