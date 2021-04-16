<?php
    
    session_start();    

    require_once("connect.php");

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    $id = $_GET['id'];
    
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }else{
        if(isset($_GET['id'])){

            
            $result = $conn->query("SELECT * FROM ogloszenia where id = " . $id);

            $ad_exist = $result->num_rows;
                 
            if ($ad_exist>0){  

                $row = $result->fetch_assoc(); 
                
                $email = $row["email"];
                $phonenumber = $row["phone_number"];
                $city = $row["city"];
                $zipcode = $row["zip_code"];
                $street = $row["adress"];
                $homenumber = $row["house_number"];
                $title = $row["ad_title"];
                $description = $row["ad_description"];
                $category =$row["category"];
                $date = $row["date"];
                $name = $row["name"];
                $image = $row["image"];
                $price = $row["price"];
                unset($_GET["id"]);
                
            }else
            {
              $_SESSION['no_ad']="Brak danej ofert!";
            }

            

        }else{
            $_SESSION['no_ad']="Brak danej ofert halo!";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ogłoszenie!</title>
    <link rel="shortcut icon" href="img/logo.png" type="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
                        <a href="accountpage.php" class="nav-link animatedButton">KONTO</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a href="addad.php" class="nav-link animatedButton">DODAJ OGŁOSZENIE</a>
                    </li>
                </ul>

            </div>

        </nav>
    </header>

    <div>
        <?php
            if(isset($_SESSION["no_ad"])){
                echo $_SESSION['no_ad'];

                echo '<style type="text/css">
                    #ad {
                        display: none;
                    }
                    </style>';
                    unset($_SESSION['no_ad']);

            }

        ?>
    </div>

    <div class="container mt-4" id="ad">
        <div class="row">
            <div class="col-lg-7 col-12">
                <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="upload/GOPR4711.JPG" class="d-block w-100" alt="Zdjęcie oferty">
                      </div>
                      <div class="carousel-item">
                        <img src="upload/GOPR5469.JPG" class="d-block w-100" alt="Zdjęcie oferty">
                      </div>
                      <div class="carousel-item">
                        <img src="upload/GOPR5582.JPG" class="d-block w-100" alt="">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
            <div class="col-lg-5" style="border:1px solid rgb(209, 209, 209); border-radius: 1%;">
                <div>
                    <h1 class="text-end m-1 p-3" style="border-bottom: 2px solid grey;"><?php echo $title; ?></h1>    
                </div>
                <div class="m-3">  
                    <div class="text-end" style="font-size: x-large;">
                        <b><?php echo $price; ?> PLN</b>
                    </div>
                    <div class="text-end mt-5" style="font-size: large;">
                        <b><?php echo $name; ?></b>
                    </div>
                </div>
                
                <div class="text-end">
                        <a class="btn btn-outline-primary me-3" id="hidennumber">Pokaż numer</a>
                        <a class="btn btn-outline-primary me-3" id="hidenemail">Pokaż e-mail</a>
                </div>
                <div class="m-3 text-end pb-3" style="border-bottom: 2px solid grey;">
                        <header><b>Lokalizacja:</b></header>
                        <?php echo $city; ?>
                </div>

                <div class="m-3" style="overflow: hidden;">
                    <header><b>Opis:</b></header>
                    <div class="coto" id="descriptionDiv">
                    <?php echo $description; ?>
                    </div>
                    <div class="text-center">
                    <a href="#more">Pokaż więcej</a>
                    </div> 
                </div>
                        
            </div> 
        </div>
        <div class="row mt-5 mb-5" style="height: 100%;">
            <header><b>Pełny opis:</b></header>
            <div id="more">
                <?php echo $description; ?>     
            </div>
        
        </div>
    </div>


    <script>

        var phone = "<?php echo $phonenumber; ?>";
        var email = "<?php echo $email; ?>";
        document.getElementById("hidennumber").onclick = function(){
            document.getElementById('hidennumber').text = phone; 
        }
        document.getElementById("hidenemail").onclick = function(){
            document.getElementById('hidenemail').text = email; 
        }


    </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    

</body>
</html>