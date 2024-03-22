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
    <form class="form_signup" method="post" action="login.php">
        <h1>Login</h1>
            <input type="text" name="brukernavn_form" placeholder="Username">
        <input type="password" name="passord_form" placeholder="Password">
        <a href="signup.php"><p style="text-decoration: underline; cursor-pointer: pointer; color: #fff;">"Signup"</p></a>
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

    // Code for login
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Getting form data
        $brukernavn = $_POST["brukernavn_form"];
        $passord = $_POST["passord_form"];

        // Preparing SQL statement
        $sql = "SELECT * FROM FjellInfo WHERE brukernavn='$brukernavn' AND passord='$passord'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, redirect to app.php
            $_SESSION['brukernavn'] = $brukernavn; // Set the 'brukernavn' session variable to the logged-in username
            header("Location: app.php");
            exit(); // Ensure that subsequent code is not executed after redirection
        } else {
            // User not found or credentials incorrect, redirect back to login.php
            $feil = "<div class='feil'>Wrong username or password</div>";
            exit(); // Ensure that subsequent code is not executed after redirection
        }
    }

    // Closing database connection
    $conn->close();
?>
</body>
</html>
