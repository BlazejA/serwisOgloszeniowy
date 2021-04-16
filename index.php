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

            <a href="#" class="navbar-brand order-first ms-1">
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
                        <a href="#" class="nav-link animatedButton active">STRONA GŁÓWNA</a>
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

<div class="container mt-5 pt-5">
        
    <div class="row">
        <p class="text-center fs-1">Witaj na ogłoszenia sjz!</p>
    </div>
    <div class="row text-center mt-5">
        <div class="row categorytext">
            <div class="col-6 col-sm-3 text-wrap my-1">
                <a href="adslist.php">                
                    <img src="img/all.png" alt="" width="50px" height="50px"></img>
                    <p>Pokaż wszystko</p>
                </a>
            </div>
            <div class="col-6 col-sm-3 my-1">
                <a href="adslist.php?category=Motoryzacja">
                    <img src="img/car.png" alt="" width="50px" height="50px"></img>
                    <p>Motoryzacja</p>
                </a>
            </div>
            <div class="col-6 col-sm-3 my-1">
                <a href="adslist.php?category=Nieruchomości">
                    <img src="img/house.png" alt="" width="50px" height="50px"></img>
                    <p>Nieruchomości</p>
                </a>
            </div>
            <div class="col-6 col-sm-3 my-1">
                <a href="adslist.php?category=Praca">
                    <img src="img/work.png" alt="" width="50px" height="50px"></img>
                    <p>Praca</p>
                </a>
            </div>        
            <div class="col-6 col-sm-3 my-1">
                <a href="adslist.php?category=Elektronika">
                    <img src="img/electronics.png" alt="" width="50px" height="50px"></img>
                    <p>Elektronika</p>
                </a>
            </div>
            <div class="col-6 col-sm-3 my-1">
                <a href="adslist.php?category=Ubrania">
                    <img src="img/clothes.png" alt="" width="50px" height="50px"></img>
                    <p>Ubrania</p>
                </a>
            </div>
            <div class="col-6 col-sm-3 my-1">
                <a href="adslist.php?category=Sport">
                    <img src="img/sport.png" alt="" width="50px" height="50px"></img>
                    <p>Sport</p>
                </a>
            </div>
            <div class="col-6 col-sm-3 my-1">
                <a href="adslist.php?category=Książki">
                    <img src="img/book.png" alt="" width="50px" height="50px"></img>
                    <p>Książki</p>
                </a>
            </div>
        </div>
    </div>

</div>
 

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>