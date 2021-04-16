<?php

require_once("connect.php");

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }else{

        $result = $conn->query("SELECT * FROM ogloszenia WHERE user_id = " .$_SESSION['user_id']);
        

        $ad_exist = $result->num_rows;
                        
        if ($ad_exist>0){ 
            
            while($row = $result->fetch_assoc() ){ 
                
            $city = $row["city"];
            $title = $row["ad_title"];
            $description = $row["ad_description"];
            $category =$row["category"];
            $date = $row["date"];
            $name = $row["name"];
            $image = $row["image"];
            $price = $row["price"];                
            $id= $row["id"]; 

        ?>
          
        <div class="row adbox">  
            <div>
                <form method="POST">
                    Edit
                    <input type="submit" value="Usuń" name="delete">
                </form>
            </div>                        
            <div class="col-12 col-md-3">
                <a href="ad.php?id=<?php echo $id; ?>">
                    <img src="img/telefon.jpg" alt="Zdjecie oferty" class="adsimg"/>
                </a> 
            </div>
            <div class="col-7" style="margin-top: 10px;">
                <div class="adtitle">
                    <a href="ad.php?id=<?php echo $id; ?>"><?php echo $title; ?></a>                        
                </div> 
                <div class="adsdesc">
                <?php echo $description; ?> 
                </div>
            </div>  
            <div class="col-sm-2 col-5" style="margin-top: 10px;">
                <div class="adsprice">
                    <?php echo $price; ?> zł                         
                </div>
                <div class="adsname">                        
                <?php echo $name; ?> <br>
                <?php echo $city; ?> 
                </div>
            </div>
        </div>        
       
        <?php 
            }

            if(isset($_POST['delete'])){

                $sql = "DELETE FROM ogloszenia WHERE id = ". $id;
                if ($conn->query($sql)) {
                    echo "Ogłoszenie usunięte!";                
                    unset($_POST['delete']);
                    header("Location: accountpage.php");
                } else {
                    echo "Error : " . $conn->error;
                }

            }            
        }else{
            echo "Brak ofert!";
        }
    }

?>
