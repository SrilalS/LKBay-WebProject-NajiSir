<?php
// Start the session
session_start();
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - LKBay.lk</title>
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
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Log In</h2>
                </div>

<?php
$Email='';
$Pws='';

$ERROR='';

      
if(isset($_POST['email'])) { 
    $Email=$_POST['email'];
} 
if(isset($_POST['password'])) { 
    $Pws=$_POST['password'];
}
                    for ($i=1; $i < 5; $i++) {
                        $ERROR = ''; 
                        $url = 'https://firestore.googleapis.com/v1/projects/lkbay-bd5eb/databases/(default)/documents/BUYERS/';
                        $url .=$i;
                        $url .='/';
                    
                        $json = @file_get_contents($url);
                        $JSONobj = json_decode($json,true);
                        #print_r ($JSONobj);
                        
                        if ($JSONobj !==null){
                            $emailgot = $JSONobj['fields']['E']['stringValue'];
                            $namegot = $JSONobj['fields']['N']['stringValue'];
                            $pwgot = $JSONobj['fields']['P']['stringValue'];
                            $ad=$JSONobj['fields']['AD']['stringValue'];
                            $bd=$JSONobj['fields']['BD']['stringValue'];
                            $s=$JSONobj['fields']['S']['integerValue'];
                            
                            

                            if ($emailgot == $Email && $Pws==$pwgot){

                                
                            $_SESSION["N"] = $namegot;
                            $_SESSION["E"] = $emailgot;
                            $_SESSION["AD"] = $ad;
                            $_SESSION["BD"] = $bd;
                            $_SESSION["S"] = $s;
                            setcookie("E", $_SESSION["E"], time()+2*24*60*60); 
                            $ERROR = '';

                            //break;
                            header("Location: ./account.php");
                            exit;
                            }
                        } else {
                            $ERROR = 'Invalid Login or Session Expired!';
                        }

                        

                        
                        
                    }
                   
echo <<<FRM
                <form method="post">
                <span class="badge badge-warning">$ERROR</span><br>
                    <div class="form-group"><label for="email" >Email</label>
                    <input class="form-control item" type="email" name="email"></div>
                    <div class="form-group"><label for="password">Password</label>
                    <input class="form-control" type="password" name="password"></div>
                    <input class="btn btn-primary btn-block" type="submit" value="Log In" name="button1">
                    <label for="password" style="margin-top: 20px;">
                        <a href="registration.php">Don't have an Account?</a>
                    </label>
                </form>
FRM;
?>

            </div>
        </section>
    </main>
    <footer class="page-footer dark fixed-bottom">
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