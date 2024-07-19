<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<title>GPTNotes</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/fontawesome-all.css" rel="stylesheet">
<link href="css/swiper.css" rel="stylesheet">
<link href="css/magnific-popup.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<script src="js/jq.js"></script>
<script src="js/bootstrap2.js"></script>
<link rel="icon" href="images/favicon.png">
</head>

<body data-spy="scroll" data-target=".fixed-top">


<div class="spinner-wrapper">
<div class="spinner">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
</div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
<div class="container">
    <a class="navbar-brand logo-image" href="index.php"><img src="./images/logo.png" alt="alternative"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-awesome fas fa-bars"></span>
        <span class="navbar-toggler-awesome fas fa-times"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link page-scroll" href="addNotes.php"><span><i class="fas fa-plus"></i> </span>
                    Add Note <span class="sr-only">(current)</span></a>
            </li>
        <li class="nav-item">
            <?php
            if (isset($_SESSION['username'])) { ?>
                <span class="nav-item">
                    <a class="nav-link page-scroll" href="notes.php"><i class="far fa-clipboard"></i> My Notes
                    </a>
                </span>
            <?php } else { ?>
                <span class="nav-item">
                    <a class="nav-link page-scroll" href="login.php"> <i class="fas fa-sign-in-alt"></i>
                        Login</a>
                </span>
            <?php } ?>

        </li>
            <li class="nav-item">
                <a class="nav-link page-scroll" href="./contact.php"><i class="far fa-paper-plane"></i> Contact Us</a>
            </li>
        </ul>
        <?php
        if (isset($_SESSION['username'])) { ?>
            <span class="nav-item ml-auto">
                <a class="btn-outline-sm page-scroll" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign
                    out</a>
            </span>

        <?php } else { ?>
            <span class="nav-item ml-auto">
                <a class="btn-solid-reg page-scroll" href="login.php"><i class="fas fa-user-plus"></i> Sign up</a>
            </span>
        <?php } ?>
    </div>
</div>
</nav>