<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body style="background: #232323;">
 
<h2 style="color: #fff;">Sjekk Status</h2>
 
<!-- Skjema for å sjekke status -->
<form action=""method="post">
    <label for="saksnummer" style="color: #fff; font-size: 20px;"> Saksnummer:</label><br>
    <input style="border: 2px solid #0A84FF; padding: 8px 12px; background: transparent; border-radius: 8px;" type="text" id="saksnummer" name="saksnummer" required><br><br>
    <input type="submit" value="Sjekk Status">
</form>
 
<?php
// Inkluderer databasetilkoblingen
$servername = "localhost";
$username = "root";
$password = "Admin";
$database = "FjellDatabase";

// Oppretter tilkobling
$conn = mysqli_connect($servername, $username, $password, $database);

// Sjekker tilkoblingsstatus
if (!$conn) {
    die("Tilkoblingsfeil: " . mysqli_connect_error());
}

// Sjekker om skjemaet er sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Henter og rens innsendt saksnummer
    $saksnummer = mysqli_real_escape_string($conn, $_POST['saksnummer']);

    // SQL-spørring for å hente status basert på saksnummer
    $sql = "SELECT * FROM FjellTicketInfo WHERE sakNummer = ?";

    // Bruk av forberedt uttalelse
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $saksnummer);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Saksnummeret ble funnet, vis statusen
            $row = mysqli_fetch_assoc($result);
            echo "Navn: " . $row['sakNavn'] . "<br>";
            echo "E-post: " . $row['sakEpost'] . "<br>";
            echo "Beskrivelse: " . $row['sakBeskrivelse'] . "<br>";
            echo "Status: " . $row['status'] . "<br>";
        } else {
            // Saksnummeret ble ikke funnet
            echo "Ingen henvendelse med dette saksnummeret ble funnet.";
        }
    } else {
        echo "Feil ved henting av status: " . mysqli_error($conn);
    }
}

// Lukker tilkobling
mysqli_close($conn);
?>

   
</body>
</html>