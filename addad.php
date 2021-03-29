<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj ogłoszenie!</title>
    <link rel="shortcut icon" href="img/logo.png" type="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet"href="css/style.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
</head>
<body>

    <header class="sticky-top">
        <nav class="navbar navbar-light navbar-expand-md" style="background-color: #e6e6e6;">

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
                        <a href="accountpage.php" class="nav-link animatedButton">KONTO</a>
                    </li>
                    <li class="nav-item active mx-1">
                        <a href="#" class="nav-link animatedButton active">DODAJ OGŁOSZENIE</a>
                    </li>
                </ul>

            </div>

        </nav>
    </header>


    <div>
        <?php if(!isset($_SESSION['logged'])){ ?>
        <div class="text-center" id="loginInfo">     
            <p>Chcesz zarządzać swoim ogłoszeniem?</p>  
            <a href="loginpage.php" class="btn btn-primary">Zaloguj się!</a>  
            <div style="font-size: small; color: gray;">
                Nie masz konta? <a href="newaccount.php" style="text-decoration: none;">Załóż teraz!</a>
            </div>                       
        </div>
        <?php } ?>

        <div style="background-color: rgba(107, 153, 252, 0.1);">

        <form class="ms-3 me-3" action="newad.php" method="POST">
            <header class="mb-3 text-secondary">
                DODAJ OGŁOSZENIE 
            </header>

            <div class="row">
                <div class="col-6">
                <label for="inputEmail" class="form-label">E-mail</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="nazwa@domena.pl"
                    value="<?php if(isset($_SESSION['logged'])) echo $_SESSION["email"]; ?>" required>            
                </div>
                <div class="col-6">
                <label for="inputPhoneNumber" class="form-label">Numer telefonu</label>
                <input type="tel" id="inputPhoneNumber" class="form-control" placeholder="505101202" maxlength="9" pattern="[0-9]{9}"
                    title="Wpisz 9 cyfrowy numer telefonu np.505123123" name="phone_number"
                    value="<?php if(isset($_SESSION['logged']) && isset($_SESSION["phonenumber"])) echo $_SESSION["phonenumber"]; ?>">  
            
                </div>
            </div>

            <div class="mt-2"> 
                <label class="form-label col-auto" for="city">Adres</label>               
                <div class="form-group row">                                    
                    <div class="col-2">
                        <input type="text" id="city" class="form-control " placeholder="Jastrzębie-zdrój" maxlength="20" name="city" required>
                        <small class="form-text text-muted">Miejscowość</small>
                    </div>
                
                    <div class="form-group col-sm-2 col-1">   
                        <div class="input-group">                
                            <input type="text" id="zipcode" class="form-control" placeholder="40-250" maxlength="6"
                                pattern="^[0-9]{2}-[0-9]{3}$" title="Wpisz kod pocztowy np. 40-250" name="zipcode"
                                oninput="if(this.value.length==2 && this.value.indexOf('-')==-1) this.value+='-';" required>                             
                            <button class="btn btn-outline-danger" onclick="document.getElementById('zipcode').value = '';"
                                 type="button" id="test">X</button>                          
                        </div>                    
                        <small class="form-text text-muted">Kod pocztowy</small>
                    </div>         

                    <div class="form-group col-2">                    
                        <input type="text" id="street" class="form-control" placeholder="Kwiatowa" maxlength="20" name="street">
                        <small class="form-text text-muted">Ulica</small>
                    </div>
                    <div class="form-group col-2">                    
                        <input type="text" id="homenumber" class="form-control" placeholder="13a" maxlength="5" name="homenumber">
                        <small class="form-text text-muted">Numer domu</small>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-3">
                    <label for="dropbtn" class="mt-2" class="form-label">Kategoria</label>
                    <div class="dropdown mt-1">                
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropbtn" data-bs-toggle="dropdown" aria-expanded="false">
                            Wybierz kategorię
                        </button>
                        <ul class="dropdown-menu" id="dropdown" aria-labelledby="dropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                        <input type="hidden" name="category" id="category">
                    </div>
                </div>
                <div class="col-2">
                    <label for="price" class="form-label">Cena</label>
                    <div class="input-group"> 
                        <input id="price" class="form-control" placeholder="1000" name="price" required>
                        <span class="input-group-text" id="basic-addon1">PLN</span>   
                    </div>
                </div>
            </div>

            <label for="adTitle" class="form-label mt-2">Nazwa ogłoszenie</label>
            <input id="adTitle" class="form-control" placeholder="Mieszkanie M4" name="title" required>                 

            <label for="inputDescr" class="form-label mt-2">Opis produktu</label>
            <textarea id="inputDescr" class="form-control" placeholder="Sprzedam mieszkanie do remontu." maxlength="800" rows="3"
                    name="descri" required></textarea>  

            <label for="file" class="form-label">Dodaj zdjęcia</label>      
            <input type='file' name='file' class="form-control" id="file" multiple>

            <input type="submit" class="btn btn-primary mt-2" name="addnewad" value="Dodaj ogłoszenie!">

        </form>
        
        </div>
    </div>
   

      
    <script>     
        $('#dropdown li').on('click', function(){
            var selText = $(this).text();
            document.getElementById("dropbtn").innerHTML=selText;
            document.getElementById("category").value = selText;
        });


        

    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</body>
</html>