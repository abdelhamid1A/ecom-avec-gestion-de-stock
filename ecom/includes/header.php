<?php
include 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="goto-here">
    <div class="py-1 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-phone2"></span></div>
                            <span class="text">+ 1235 2355 98</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-paper-plane"></span></div>
                            <span class="text">youremail@email.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text"><strong>ممنوع الطلق ورزق على الله</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">موحماد</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
                    <?php
                    $sql = "SELECT * from categorie";
                    $result = query($sql);
                    if ($result) :
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Shop</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <?php while ($cat = mysqli_fetch_array($result)) : ?>
                            <a class="dropdown-item" href="Category.php?id=<?php echo $cat['ID_CAT'] ?>"><?php echo $cat['DESC_cat'] ?></a>
                            <?php endwhile; ?>
                        </div>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">compte</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <?php
                            if (isset($_SESSION['log']) && $_SESSION['log'] = true) : ?>
                            <a class="dropdown-item" href="login.php"><?php echo $_SESSION['nom'] ?></a>
                            <a class="dropdown-item" href="logout.php">logout</a>

                            <?php elseif(isset($_SESSION['logadmin']) && $_SESSION['logadmin']=true): ?>
		                        <a class="dropdown-item" href="login.php"><?php echo $_SESSION['nom'] ?></a>
				                    <a class="dropdown-item" href="logout.php">logout</a>

                            <?php else : ?>
                            <a class="dropdown-item" href="login.php">login</a>
                            <a class="dropdown-item" href="inscription.php">inscription</a>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="nav-item cta cta-colored">
                        <a href="cart.php" class="nav-link">
                            <span class="icon-shopping_cart"></span>
                            <span id="cart-items">0</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->