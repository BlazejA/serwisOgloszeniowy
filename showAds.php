<?php

require_once("connect.php");

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }else{
        

        if(isset($_GET['category'])){
            $cat = $_GET['category'];
            $result = $conn->query("SELECT * FROM ogloszenia WHERE category = '{$cat}'");            
            $ad_exist = $result->num_rows;
            
        }
        else{
            $result = $conn->query("SELECT * FROM ogloszenia");
            $ad_exist = $result->num_rows;
            
        }
                        
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
        <div class="row adbox mt-1">                
            <div class="col-sm-3 col-12">
                <a href="ad.php?id=<?php echo $id; ?>" style="margin:-10px;">
                    <img src="img/telefon.jpg" alt="Zdjecie oferty" class="adsimg" width="100%"/>
                </a>  
            </div>
            <div class="col-7 text-center text-sm-start" style="margin-top: 10px;">
                <div class="adtitle text-break">
                    <a href="ad.php?id=<?php echo $id; ?>"><?php echo $title; ?></a>                        
                </div> 
                <div class="adsdesc text-break">
                    <?php echo $description; ?> 
                </div>
            </div>  
            <div class="col-sm-2 col-5" style="margin-top: 10px;">
                <div class="adsprice text-break">
                    <?php echo $price; ?> zł                         
                </div>
                <div class="adsname text-break">                        
                <?php echo $name; ?> <br>
                <?php echo $city; ?> 
                </div>                
            </div>
        </div>        
       
        <?php 
            }
        }else{
            echo "<div class='my-5 text-center' style='height: 100%;'><h3>Brak ofert!</h3></div>";
        }
    }

?>
