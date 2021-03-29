<?php

require_once("connect.php");

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }else{

        $result = $conn->query("SELECT * FROM ogloszenia");

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
            <div class="col-3">
                <img src="telefon.jpg" alt="Zdjecie oferty" class="adsimg"/> 
            </div>
            <div class="col-7" style="margin-top: 10px;">
                <div class="adtitle">
                    <a href="ad.php?id=<?php echo $id; ?>"><?php echo $title; ?></a>                        
                </div> 
                <div class="adsdesc">
                <?php echo $description; ?> 
                </div>
            </div>  
            <div class="col-2" style="margin-top: 10px;">
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
        }else{
            $_SESSION['no_ad']="Brak oferty!";
        }
    }

?>