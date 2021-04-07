<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serwis ogłoszeń</title>
    <link rel="shortcut icon" href="img/logo.png" type="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
        <nav class="navbar navbar-light navbar-expand-md fixed-top" style="background-color: #e6e6e6;">

            <a href="index.php" class="navbar-brand order-first ms-1">
                <img src="img/logo.png" alt="" width="70px" height="70px" class="d-inline-block">
                 Joszczymbiok
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu"
            aria-controls="mainmenu" aria-expanded="false" aria-label="przełacznik nawigacji">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainmenu" class="collapse navbar-collapse ">
                
                <ul class="navbar-nav ms-auto me-2 order-first">
                    <label class="nav-link disabled"><?php if(isset($_SESSION['logged'])) echo "Zalogowano jako: ".$_SESSION['email'] ?></label>
                    <li class="nav-item active">
                        <a href="index.php" class="nav-link animatedButton active">STRONA GŁÓWNA</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a href="accountpage.php" class="nav-link animatedButton">KONTO</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a href="addad.php" class="nav-link animatedButton">DODAJ OGŁOSZENIE</a>
                    </li>
                </ul>

            </div>

        </nav>
</header>

    <div class="container page">
        
        <div class="pagenav">
            <div>
                
                <div class="dropdown m-1"> 
                Kategoria:               
                    <button class="btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropbtn" data-bs-toggle="dropdown" aria-expanded="false">
                        Wybierz kategorię
                    </button>
                    <ul class="dropdown-menu" id="dropdown" aria-labelledby="dropdown">
                        <li><a class="dropdown-item" href="#">Pokaż wszystko</a></li>
                        <li><a class="dropdown-item" href="#">Motoryzacja</a></li>
                        <li><a class="dropdown-item" href="#">Nieruchomości</a></li>
                        <li><a class="dropdown-item" href="#">Elektronika</a></li>
                        <li><a class="dropdown-item" href="#">Ubrania</a></li>
                        <li><a class="dropdown-item" href="#">Sport</a></li>
                        <li><a class="dropdown-item" href="#">Książki</a></li>
                        <li><a class="dropdown-item" href="#">Praca</a></li>
                    </ul>
                    <input type="hidden" name="category" id="category">
                </div>
            </div>
        </div>

        <div class="ads"> 
            
        <?php include("showAds.php"); ?>            

        </div>

    </div>
    


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


    </body>
</html>