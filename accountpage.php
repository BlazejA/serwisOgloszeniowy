<?php
session_start();

require_once "connect.php"; 

$conn = new mysqli($host, $db_user, $db_password, $db_name);
$sql = "";

if(isset($_POST['changeData'])){   

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

    if($_POST['email'] != ""){
        $sql = "UPDATE uzytkownicy SET email='".$_POST['email']."' WHERE user_id=".$_SESSION["user_id"];
        unset($_SESSION['email']);
        $_SESSION['email'] = $_POST['email'];
    }
    if($_POST['phoneNumber'] != ""){
        $sql = "UPDATE uzytkownicy SET phone_number='".$_POST['phoneNumber']."' WHERE user_id=".$_SESSION["user_id"];
        unset($_SESSION['phonenumber']);
        $_SESSION['phonenumber'] = $_POST['phoneNumber'];
    }
    if($_POST['password'] != ""){
        
        if($_POST['oldpassword'] != ""){

            $result = $conn->query("SELECT * FROM uzytkownicy WHERE user_id=".$_SESSION["user_id"]);
            $row = $result->fetch_assoc();

            if(password_verify($_POST['password'], $row['password'])){
                $password=$_POST['password'];
                $sql = "UPDATE uzytkownicy SET password='" . password_hash($password,PASSWORD_DEFAULT) . "' WHERE user_id=".$_SESSION["user_id"];                 
            }else{
                $_SESSION['error_wrong_pass'] = "Błędne hasło!";
            }
        }else{
            $_SESSION['error_wrong_pass'] = "Podaj stare hasło!";
        }
    }
    if(!empty($_POST['email']) || !empty($_POST['phoneNumber']) || (!empty($_POST['password']) && !empty($_POST['oldpassword']))){
        if ($conn->query($sql)) {
            $_SESSION['data_changed']="Dane zostały zmienione!";
            header("loaction: accountpage.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
$conn->close();

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
    <link rel="stylesheet"href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
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
        <a href="loginpage.php" class="btn btn-primary mt-1">Zaloguj się!</a> <br> 
        <strong class="mt-5">Jeśli jesteś u nas pierwszy raz</strong>  
        <a href="newaccount.php" class="btn btn-primary mt-1">Załóż konto!</a>  
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
        <div class="col-6 col-md-3" >
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
            <p>Numer telefonu: <?php if(isset($_SESSION['phonenumber'])) echo $_SESSION['phonenumber'] ?> </p>
            <button class="btn btn-sm btn-outline-secondary" onclick="showSection()">Edytuj dane</button>
        </div>

        <div class="col-12 col-md-9" id="my_ad" style="display: none;">
            <?php include("showUserAds.php"); ?>
        </div> 

        <div class="col-12 col-md-4 mt-md-0 mt-2" style="display: none;" id="change">
            <form method="POST">

                Nowy mail:
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="nazwa@domena.pl">
                Nowy numer telefonu:
                <input type="tel" id="inputPhoneNumber" class="form-control" placeholder="505101202" maxlength="9"
                    pattern="[0-9]{9}" title="Wpisz 9 cyfrowy numer telefonu np.505123123" name="phoneNumber">
                Zmiana hasła:                
                <input type="password" id="password" class="form-control" placeholder="NoweHaslo1" maxlength="20"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="password"
                    title="Hasło musi składać się z minimum 6 znaków oraz zawierać przynajmniej jedną małą i jedną dużą literę oraz jedną cyfrę">
                Jeśli chcesz zmienić hasło, podaj stare hasło:
                <input type="password" id="password" class="form-control" placeholder="StareHaslo1" maxlength="20"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="oldpassword"
                    title="Hasło musi składać się z minimum 6 znaków oraz zawierać przynajmniej jedną małą i jedną dużą literę oraz jedną cyfrę">
                    <?php
                    if(isset($_SESSION['error_wrong_pass'])){
                        echo '<div id="wrong_data" style="color: red;">'. $_SESSION['error_wrong_pass'] .'</div>';
                        unset($_SESSION['error_wrong_pass']);
                    }
                    ?>
                
                
                <input type="submit" class="btn btn-primary mt-2" name="changeData" value="Zmień dane">

            </form>
        </div>
    </div>
    <div>
    <?php
        if(isset($_SESSION['data_changed'])){
            echo '<div id="hidesuccess" style="color: green;">'. $_SESSION['data_changed'] .'</div>';
            unset($_SESSION['data_changed']);
        }
    ?>
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
        var section = document.getElementById("change");
        if (data.style.display == "none" ) {
            data.style.display = "block";
            ad.style.display = "none";             
            section.style.display = "none";      
        }
        else {
            data.style.display = "none";
            ad.style.display = "none";
            section.style.display = "none";
        }
    }
    function showAd() {
        var data = document.getElementById("account_data");
        var ad = document.getElementById("my_ad");
        var section = document.getElementById("change");
        if (ad.style.display == "none" ) {
            ad.style.display = "block";
            data.style.display = "none"; 
            section.style.display = "none";
        }
        else {
            data.style.display = "none";
            ad.style.display = "none";
            section.style.display = "none";
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

    setTimeout(fade_out, 5000);

    function fade_out() {
    $("#hidesuccess").fadeOut().empty();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    

</body>
</html>
