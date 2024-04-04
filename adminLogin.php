<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100..900&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>

<div class="signup_form_container">
    <form class="form_signup" method="post" action="adminLogin.php">
        <h1>Admin login</h1>
        <?php echo $feil; ?>
        <input type="text" name="admin_brukernavn" placeholder="Username">
        <input type="password" name="admin_passord" placeholder="Password">
        <a style="color: #fff; padding: 10px 0;" href="app.php">"< Back"</a>
        <button type="submit">Login</button>
    </form>
</div>





<?php 

    $servername = "localhost";
    $username = "root";
    $password = "Admin";
    $database = "FjellDatabase";

    // Creating database connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Checking connection
    if ($conn->connect_error) {
        die ("Connection Failed: " . $conn->connect_error);
    }

    // Code for admin login

    if ($_SERVER["REQUEST_METHOD"] == "POST" )  {
        //Getting form data
        $adminNavn = $_POST["admin_brukernavn"];
        $adminPassord = $_POST["admin_passord"];

         // Creating database connection
         $conn = new mysqli($servername, $username, $password, $database);

        // Checking connection
        if ($conn->connect_error) {
            die ("Connection Failed: " . $conn->connect_error);
        }

        // Preparing SQL statement
        $sql = "SELECT * FROM FjellInfo WHERE brukernavn='$adminNavn' AND passord='$adminPassord'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, redirect to app.php
            $_SESSION['brukernavn'] = $adminNavn; // Set the 'brukernavn' session variable to the logged-in username
            header("Location: sakSide.php");
            exit(); // Ensure that subsequent code is not executed after redirection
        } else {
            // User not found or credentials incorrect, redirect back to login.php
            $feil = "<div class='feil'>Wrong username or password</div>";
            exit(); // Ensure that subsequent code is not executed after redirection
        }


        if ($result->num_rows > 1) {
            // Admin found, redirect to test.php
            $_SESSION['brukernavn'] = $adminNavn; // Set the 'brukernavn' session variable to the logged-in username
            header("Location: test.php");
            exit(); // Ensure that subsequent code is not executed after redirection
        } else {
            // Admin not found or credentials incorrect, redirect back to login.php
            $feil = "<div class='feil'>Wrong username or password</div>";
            exit(); // Ensure that subsequent code is not executed after redirection
        }
    }


?>
    
</body>
</html>