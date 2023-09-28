<html>
    <head>
        <title>Baugram - Profile</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-widht, initial scale=1"/>
        <link rel="icon" href="../util/logo-icona.png"/>
       
        <!-- Importo bootstrap CSS e JS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <!-- Importo JQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

        <!-- Importo animate CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

        <!-- Importo il mio CSS per questa pagina -->
        <link rel="stylesheet" href="profilo-pub.css"/>

        <!-- Importo libreria per icone -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>

        <?php
            include_once('../libraries/mysql-fix.php');
            include_once('../libraries/myfunctions.php');
            $host = "localhost";
            $user = "baugram";
            $pass = "Baugram2020";
            $db = "my_baugram";
            connectToDB($host, $user, $pass, $db);
            session_start();
            $searched_username = $_POST['searchtext'];
            //controllo che l'utente non abbia cercato il proprio username
            // se si, ritorna alla pagina profilo personale
            if ($searched_username == $_SESSION['username']) {
            	header("Location: ../pagina-profilo/profilo.php");
            }
            $result = mysql_query("select * from utenti where username='$searched_username'")
            		  or die("Errore nella ricerca: " . mysql_error());
            //controllo che lo username esista
            if (!($user = mysql_fetch_array($result, MYSQL_ASSOC))) {
            	header("Location: ../pagina-profilo/profilo.php");
            }
        ?>

        <ul>
            <li><i class="fas fa-home"></i></li>
            <li><i class="fas fa-paw"></i></li>
            <li><a href="../pagina-profilo/profilo.php"><i class="fas fa-dog"></i></a></li>
            <li style="float: right; padding-top: 10px; padding-right: 10px;">
                <form action="./profilo-pub.php" name="search-user-form" method="post">
                    <input type="text" id="searchtext" name="searchtext" size="25" placeholder="Search">
                    <button name="searchSubmitButton" class="btn btn-lg btn-white" type="submit" style="text-align: center;"><i class="fas fa-search" style="font-size:14px;"></i></button>
                </form>
            </li>
        </ul>

        <div class="profile-descr-zone">
        	<?php
            	$result = mysql_query("select * from utenti_fotoprofilo where username='" . $user['username'] . "'")
                		  or die("Errore nella selezione della foto profilo");
              	$img = mysql_fetch_array($result);
                if ($img['nome_file'] == NULL) {
                	echo "<img src='../pictures/senza-foto-profilo.jpg' style='border-radius:180px; heigth:160; width:160;'>";
                }
            	else { 
                	echo "<img src='../users/" . $user['username'] . "/foto-profilo/" . $img['nome_file'] . "' style='border-radius:180px; heigth:160; width:160;'>";
                } 
            ?>
            <div style="padding-top: 1%; font-size: 30px;">
                <b>
                    <?php
                        echo $user['username'];
                    ?>
                </b>
            </div>
            <button class="btn btn-lg btn-white" name="followButton" style="border-color: black; font-size: 15;"><i class="fas fa-user-plus"></i> Follow</button>
            <button class="btn btn-lg btn-white" name="sendMessageButton" style="border-color: black; font-size: 15;"><i class="fa fa-send"></i> Send message</button>
            <br>
            <div class="profile-data">
                <table cellpadding="11px" style="text-align: center;">
                    <tr>
                        <td><b><?php echo $user['n_post']; ?></b> post</td>
                        <td><b><?php echo $user['n_follower']; ?></b> follower</td>
                        <td><b><?php echo $user['n_followed']; ?></b> followed</td>
                    </tr>
                </table>
            </div>
            di <b><?php echo $user['nome_padrone'] ." ". $user['cognome_padrone']; ?></b>
            <br>
            <div style="font-size: 13;">
                <?php echo $user['descrizione']; ?>
           	</div>
        </div>
        <hr style="background-color: black;">
    </body>
</html>