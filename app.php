<?php 
session_start();

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

// Code for "sak innsending"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Getting form data 
    $sakNavn = $_POST["sakNavn"];
    $sakEpost = $_POST["sakEpost"];
    $sakTekst = $_POST["sakTekst"];

    // Preparing SQL statement
    $sql = "INSERT INTO FjellTicketInfo (sakNavn, sakEpost, sakBeskrivelse) VALUES ('$sakNavn', '$sakEpost', '$sakTekst')";

    if ($conn->query($sql) === TRUE) {
        // Get the last inserted ID
        $last_inserted_id = $conn->insert_id;
        echo "SakNummer: " . $last_inserted_id; // Print the SakNummer back to the user
    } else {
        echo "Error sak kunne ikke bli sendt" . $conn->error;
    }   

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Document</title>
</head>
<body>

<div class="header-wrapper">
    <h1 class="ticket_title">TicketSystem
        <br>
        <div class="welcome_user_text">
            <?php 
            if(isset($_SESSION['brukernavn'])){
                echo 'Welcome, ' . $_SESSION['brukernavn'];
            } else{
                echo 'Please log in';
            }
            ?>
        </div>
    </h1>

    <div class="menu">
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
</div>

<div class="open-menu-container">
    <div class="open-menu">
        <a href="adminLogin.php"><p>Søk etter sak</p></a>
        <a href="logout.php"><button>Log out</button></a>
    </div>
</div>

<div class="ticket-send-in">

    <form action="app.php" method="POST" class="ticket-send-in-form">
        <input type="text" name="sakNavn" id="" placeholder="Navn">
        <input type="text" name="sakEpost" id="" placeholder="E-post">
        <textarea name="sakTekst" id="" cols="30" rows="10" placeholder="Sak"></textarea>
        <button type="submit">Send in</button>
    </form>
</div>    
</body>
</html>
