<?php

session_start();

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $pwd_hash = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $phonenumber = $_POST['phoneNumber'];

    require_once("connect.php");
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{

        $conn = new mysqli($host, $db_user, $db_password, $db_name);
        if($conn->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }else{

            $result = $conn->query("SELECT user_id FROM uzytkownicy WHERE email='$email'");

            if(!$result){
                throw new Exception($conn->error);
            }

            $email_numbers = $result->num_rows;
            if($email_numbers>0){
                $_SESSION["e_email"]="Istnieje już konto o takim adresie e-mail!";
            }
            else{
                unset($_SESSION["e_email"]);
            }

            if(!isset($_SESSION["e_email"])){

                $phonenumber = !empty($phonenumber) ? "$phonenumber" : "NULL";
                if($conn->query("INSERT INTO uzytkownicy VALUES (NULL, '$email', '$pwd_hash', '$phonenumber')")){
                    $_SESSION['register_success']=true;
                    $_SESSION['logged']=true;
                    $_SESSION['email'] = $email;
                    header("location: accountpage.php");
                }else{
                    throw new Exception($conn->error);
                }
            }

            $conn->close();
        }

    }catch(Exception $e){
        echo 'Błąd serwera! Spróbuj ponownie później!';
        echo $e;
    }
}

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

        <form class="ms-3 me-3 mt-3" method="POST">
            <header class="mb-3 text-secondary">
                Załóż konto 
            </header>
            
            <?php 
            if(isset($_SESSION["e_email"])){
                echo'<div style="color:red;">'.$_SESSION["e_email"].'</div>';
                
            }
            ?>
            <label for="inputEmail" class="form-label">E-mail</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="nazwa@domena.pl" name="email" maxlength="50" required>            

            <div>
                <label for="inputPhoneNumber" class="form-label mt-2">Numer telefonu</label>
                <input type="tel" id="inputPhoneNumber" class="form-control" placeholder="505101202" maxlength="9"
                    pattern="[0-9]{9}" title="Wpisz 9 cyfrowy numer telefonu np.505123123" name="phoneNumber">  
                <small class="form-text text-muted"> Pole niewymagane. Ułatwi kontakt dla zainteresowanych ogłoszeniem.</small>
            </div>

            <label for="password" class="form-label mt-2">Hasło</label>
            <input type="password" id="password" class="form-control" placeholder="haslo1" maxlength="20"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="password" maxlength="20"
                title="Hasło musi składać się z minimum 6 znaków oraz zawierać przynajmniej jedną małą i jedną dużą literę oraz jedną cyfrę" required>
             
            <div>
                <label for="Repassword" class="form-label mt-2">Hasło</label>
                <input type="password" id="confirm_password" class="form-control" placeholder="haslo1" maxlength="20"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                    title="Hasło musi składać się z minimum 6 znaków oraz zawierać przynajmniej jedną małą i jedną dużą literę oraz jedną cyfrę" required>
                <small id="message"></small>                  
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">
                    Akceptuję regulamin
                </label>
            </div>
            
            <input type="submit" name="submit" class="btn btn-primary mt-2" id="submitbtn" value="Załóż konto!">
            

        </form>

    </div>


<script>
    document.getElementById("confirm_password").oninput = function() {
        if (document.getElementById('password').value !=
            document.getElementById('confirm_password').value) {                
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Hasła nie są takie same!';   
            document.getElementById('submitbtn').disabled = true;
            
        } else {                           
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Hasła zgadzają się!';
            document.getElementById('submitbtn').disabled = false;
        }
    }
    document.getElementById("password").oninput = function() {
        if (document.getElementById('password').value !=
            document.getElementById('confirm_password').value) {                
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Hasła nie są takie same!'; 
            document.getElementById('submitbtn').disabled = true;           
        } else {                           
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Hasła zgadzają się!';
            document.getElementById('submitbtn').disabled = false;
        }
    }
    
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    

</body>
</html>