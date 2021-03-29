<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowe konto!</title>
    <link rel="shortcut icon" href="img/logo.png" type="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet"href="css/style.css">
</head>
<body>

    <header>
        <nav class="navbar navbar-light navbar-expand-md sticky-top" style="background-color: #e6e6e6;">

            <a href="index.php" class="navbar-brand order-first ms-1">
                <img src="img/logo.png" alt="" width="70px" height="70px" class="d-inline-block">
                 Joszczymbiok
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu"
            aria-controls="mainmenu" aria-expanded="false" aria-label="przełacznik nawigacji">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainmenu" class="collapse navbar-collapse order-last">
                
                <ul class="navbar-nav ms-auto me-2">                    

                    <label class="nav-link disabled"><?php if(isset($_SESSION['logged'])) echo "Zalogowano jako: ".$_SESSION['email'] ?></label>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link animatedButton">STRONA GŁÓWNA</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a href="#" class="nav-link animatedButton active">KONTO</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a href="addad.php" class="nav-link animatedButton">DODAJ OGŁOSZENIE</a>
                    </li>
                </ul>

            </div>

        </nav>
    </header>



    <div class="mt-4 col-4 offset-4 p-2" style="background-color: rgb(240, 240, 240);">

        <form class="ms-3 me-3 mt-3" action="login.php" method="POST">
            <header class="mb-3 text-secondary">
                Zaloguj się
            </header>
                    
            <label for="inputEmail" class="form-label">E-mail</label>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="nazwa@domena.pl" required>            

            <label for="password" class="form-label mt-2">Hasło</label>
            <input type="password" id="password" class="form-control" placeholder="haslo1" maxlength="20"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="password"
                title="Hasło musi składać się z minimum 6 znaków oraz zawierać przynajmniej jedną małą i jedną dużą literę oraz jedną cyfrę" required>
            
            <?php
                if(isset($_SESSION['error_wrong_data'])){
                    echo '<div id="wrong_data" style="color: red;">'. $_SESSION['error_wrong_data'] .'</div>';
                    unset($_SESSION['error_wrong_data']);
                }
            ?>
                

            <input type="submit" class="btn btn-primary mt-2" name="login" value="Zaloguj się!">

        </form>

       

    </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    

</body>
</html>