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
    <title>Document</title>
</head>
<body>
    
<div class="signup_form_container">
    <form class="form_signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h1>Sign Up</h1>
        <input type="text" name="brukernavn_form" id="" placeholder="brukernavn">
        <input type="password" name="passord_form" id="" placeholder="password">
        <input type="email" name="epost_form" id="" placeholder="email">
        <a href="login.php"><p style="text-decoration: underline; cursor-pointer: pointer; color: #fff;">"Login"</p></a>
        <button type="submit">Sign Up</button>
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

        echo "Connected successfully";

        // Closing database connection
        $conn->close();

        // Code for signup

        // Checking if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Getting form data
            $brukernavn = $_POST["brukernavn_form"];
            $passord = $_POST["passord_form"];
            $epost = $_POST["epost_form"];

            // Creating a new database connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Checking connection
            if ($conn->connect_error) {
                die ("Connection Failed: " . $conn->connect_error); 
            }

            // Preparing SQL statement
            $sql = "INSERT INTO FjellInfo (brukernavn, passord, email) VALUES ('$brukernavn', '$passord', '$epost')";

            if ($conn->query($sql) === TRUE) {
                echo "Sign up successfully";
            } else {
                echo "Error: " . $conn->error;
            }

            // Closing database connection
            $conn->close();
        }
    ?>
</body>
</html>
