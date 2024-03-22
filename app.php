    <?php 
    session_start();
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
        <a href="#"><p>Søk etter sak</p></a>
    <a href="logout.php"><button>Log out</button></a>
    </div>
    </div>

    <div class="ticket-send-in">

    <form action="" class="ticket-send-in-form">
        <input type="text" name="" id="" placeholder="Navn">
        <input type="text" name="" id="" placeholder="E-post">
        <textarea name="" id="" cols="30" rows="10" placeholder="Sak"></textarea>
        <button type="submit">Send in</button>
    </form>
    </div>    
    </body>
    </html>