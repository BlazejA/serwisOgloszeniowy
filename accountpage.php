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
                        <a href="accountpage.php" class="nav-link animatedButton active">KONTO</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a href="addad.php" class="nav-link animatedButton">DODAJ OGŁOSZENIE</a>
                    </li>
                </ul>

            </div>

        </nav>
    </header>
<?php 

if(!isset($_SESSION['logged'])){

?>    
    <div class="mt-4 col-4 offset-4 row text-center">
        <strong class="mt-5">Jeśli posiadasz konto</strong>
        <a href="loginpage.php" class="btn btn-primary">Zaloguj się!</a> <br> 
        <strong class="mt-5">Jeśli jesteś u nas pierwszy raz</strong>  
        <a href="newaccount.php" class="btn btn-primary">Załóż konto!</a>  
    </div>
<?php
} else{
?>

<div class="container mt-5">
    <?php if(isset($_SESSION['register_success'])){ ?>
        <div class="row">
            <strong>Rejestracja przebiegła pomyślnie!</strong>
        </div>
    <?php
        unset($_SESSION['register_success']);
    }    
    ?>
    <div class="row">
        <div class="col-3" >
            <nav style="border-right:1px solid grey;">
                <ul class="nav flex-column" style="font-size:large;">
                    <li class="nav-item">
                        <label id="account_data_btn" onclick="showData()">Moje dane</label>
                    </li>
                    <li class="nav-item mt-2">
                        <label id="my_ad_btn" onclick="showAd()">Moje ogłoszenia</label>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="btn btn-sm btn-primary" href="logout.php">Wyloguj się!</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-5" id="account_data" style="display: none;">                
            <p>E-mail: <?php echo $_SESSION['email']; ?> </p>
            <p>Numer telefonu: <?php if(isset($_SESSION['phone_number'])) echo $_SESSION['phone_number']?> </p>
            <button class="btn btn-sm btn-outline-secondary" onclick="showSection()">Edytuj dane</button>
        </div>
        <div class="col-9" id="my_ad" style="display: none;">
            <?php if(!isset($_SESSION["user_no_ad"])){ include("showUserAds.php"); } else { echo $_SESSION["user_no_ad"]; unset($_SESSION["user_no_ad"]); } ?>
        </div> 
        <div class="col-4" style="display: none;" id="change">
            <form>
                Nowy mail:
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="nazwa@domena.pl">
                Nowy numer telefonu:
                <input type="tel" id="inputPhoneNumber" class="form-control" placeholder="505101202" maxlength="9"
                    pattern="[0-9]{9}" title="Wpisz 9 cyfrowy numer telefonu np.505123123" name="phoneNumber">
                Zmiana hasła:                
                <input type="password" id="password" class="form-control" placeholder="haslo1" maxlength="20"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="password"
                    title="Hasło musi składać się z minimum 6 znaków oraz zawierać przynajmniej jedną małą i jedną dużą literę oraz jedną cyfrę">
                
                <input type="submit" class="btn btn-primary mt-2" name="changeData" value="Zmień dane">

            </form>
        </div>
    </div>
</div>
  <?php
}
?>
<!-- show hide divs-->
<script>
    function showData() {
        var data = document.getElementById("account_data");
        var ad = document.getElementById("my_ad");
        if (data.style.display == "none" ) {
            data.style.display = "block";
            ad.style.display = "none";        
        }
        else {
            data.style.display = "none";
            ad.style.display = "none";
        }
    }
    function showAd() {
        var data = document.getElementById("account_data");
        var ad = document.getElementById("my_ad");
        if (ad.style.display == "none" ) {
            ad.style.display = "block";
            data.style.display = "none";        
        }
        else {
            data.style.display = "none";
            ad.style.display = "none";
        }
    }
    function showSection(){
        var section = document.getElementById("change");
        if (section.style.display == "none" ) {
            section.style.display = "block";       
        }
        else{
            section.style.display = "none"; 
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    

</body>
</html>
