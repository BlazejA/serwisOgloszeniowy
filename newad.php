<?php
session_start();

require_once("connect.php");

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}else{

    if(isset($_POST['addnewad'])){        
      
        $today = date("y-m-d");
        $username = strstr($_POST["email"], '@', true);

        if(isset($_SESSION['logged'])){
            $userid = $_SESSION['user_id'];
        }

        $email = $_POST["email"];
        $phonenumber = $_POST["phone_number"];
        $city = $_POST["city"];
        $zipcode = $_POST["zipcode"];
        $street = $_POST["street"];
        $homenumber = $_POST["homenumber"];
        $title = $_POST["title"];
        $description = $_POST["descri"];
        $category =$_POST["category"];
        $price = $_POST["price"];


        $userid = !empty($userid) ? "$userid" : NULL;
        $email = !empty($email) ? "$email" : NULL;
        $phonenumber = !empty($phonenumber) ? "$phonenumber" : "BRAK";
        $city = !empty($city) ? "$city" : "NULL";
        $zipcode = !empty($zipcode) ? "$zipcode" : "NULL";
        $street = !empty($street) ? "$street" : "NULL";
        $homenumber = !empty($homenumber) ? "$homenumber" : "NULL";
        $title = !empty($title) ? "$title" : "NULL";
        $description = !empty($description) ? "$description" : "NULL";
        $category = !empty($category) ? "$category" : "NULL";
        $price = !empty($price) ? "$price" : "NULL";

        $name="NULL";


        $sql = "INSERT INTO ogloszenia VALUES (NULL, '$userid', ' $email', 
        '$phonenumber','$city ','$zipcode','$street','$homenumber','$title',' $description',
        '$category', '$today', '$username', '$name', $price );";

        

        if ($conn->query($sql)){
            move_uploaded_file($_POST['file'],$target_dir.$name);

            $result = $conn->query("SELECT id FROM ogloszenia ORDER BY id DESC LIMIT 1;");

            $row = $result->fetch_assoc(); 

            header("location: ad.php?id=".$row["id"]);
        }
        else 
            echo "Error: " . $conn->error;
                
    }

}
$conn->close();
?>