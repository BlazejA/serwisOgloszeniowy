<?php
session_start();

require_once "connect.php";

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
else{

    if (isset($_POST['login']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        

        $email = htmlentities($email, ENT_QUOTES, "UTF-8");
        
        if ($result = $conn->query(
            sprintf("SELECT * FROM uzytkownicy WHERE BINARY email = '%s'",
            mysqli_real_escape_string($conn, $email))))
        {   
            $user_exist = $result->num_rows;
                        
            if ($user_exist>0){  
                
                $row = $result->fetch_assoc();                
                
                if(password_verify($password, $row['password'])){

                $_SESSION['logged'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $row["user_id"];
                if($row["phone_number"]!=NULL)
                    $_SESSION["phonenumber"] = $row["phone_number"];

                unset($_SESSION['error_wrong_data']);
                $result->free_result();
                header("location:index.php");

                }else{
                    $_SESSION['error_wrong_data']="Błędne hasło!";
                    header("location:loginpage.php");
                }
            }else
            {
              $_SESSION['error_wrong_data']="Podany użytkownik nie istnieje!";
              header("location:loginpage.php");
            }   
        }
        else
        {        
          $_SESSION['error_wrong_data']="Podane dane są nieprawidłowe!";
          header("location:loginpage.php");
        }
    }
    else{
        header("location:loginpage.php");
    }

}
$conn->close();

?>