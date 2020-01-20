<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <?php
                    $name = $_GET["name"];
                    echo <<<HEAD
                    <title >$name</title>
                    HEAD;
                    ?>
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
    <main class="page product-page">
        <section class="clean-block clean-product dark">
            <div class="container">
                <div class="block-heading">
                    <?php
                    $name = $_GET["name"];
                    echo <<<HEAD
                    <h2 class="text-info">$name</h2>
                    HEAD;
                    ?>
                </div>
                <div class="block-content">
                <?php
                $name=$_GET["name"];
                $price=$_GET["price"];
                $i=$_GET["img"];
                $desc=$_GET["desc"];
                $company=$_GET["company"];

                $url = 'https://firestore.googleapis.com/v1/projects/lkbay-bd5eb/databases/(default)/documents/ITEMS/ALL/ITEMS/';
                $url .=$i;
                $url .='/';

                $json = @file_get_contents($url);
                $JSONobj = json_decode($json,true);

                $url = $JSONobj['fields']['U']['stringValue'];

                if(isset($_POST['dummy'])) { 
                    @$_SESSION["CART"] = @$_SESSION["CART"].";".$i;
                    //echo $_SESSION["CART"];
                    echo <<< MX
                        <script language="javascript">
                        alert("Item Added to the Cart!")
                        </script>
                    MX;
                }
                
                echo <<<BD
                    <div class="product-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gallery">
                                    <div class="image"><img class="img-fluid d-block mx-auto" src="$url" style="height:400px; width:400px"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <h3>$name</h3>
                                    <h5>$company</h5>
                                    <div class="price">
                                        <h3>$$price</h3>
                                    <form method="post">
                                        <input hidden type="text" value="1" name="dummy">
                                        <input type="submit" class="btn btn-primary" value="Add to Cart">
                                    </form>
                                    <div class="summary">
                                        <p>$desc</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                BD;
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
