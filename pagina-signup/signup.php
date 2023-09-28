<html>
    <head></head>
    <body>
        <?php
        	include_once('../libraries/mysql-fix.php');
            include_once('../libraries/myfunctions.php');
            
        	$host = "localhost";
            $user = "baugram";
            $pass = "Baugram2020";
            $db = "my_baugram";
            connectToDB($host, $user, $pass, $db);
 			
 			if (!(isset($_POST['submitButton']))) {
            	header("Location: ../index.html");
            }
            else {
            	//controllo utente già registrato
            	$email = $_POST['email'];
                $query = "select email from utenti where email='$email'";
        		$result = mysql_query($query);
        		if ($line=mysql_fetch_array($result,MYSQL_ASSOC)) {
 					echo "<h1> Sorry, you are already a registered user</h1>
                          <a href=../pagina-login/login.html> Click here to login</a>";
                }
                //controllo username già usato
            	$username = $_POST['username'];
                $query = "select username from utenti where username='$username'";
        		$result = mysql_query($query);
        		if ($line=mysql_fetch_array($result,MYSQL_ASSOC)) {
 					echo "<h1> Sorry, username is already used</h1>
                          <a href=../pagina-signup/signup.html> Click here to signup</a>";
                }
            	else {
            		$nome_padrone = $_POST['nomePadrone'];
                	$cognome_padrone = $_POST['cognomePadrone'];
                	$nome_cane = $_POST['nomeCane'];
                	$username = $_POST['username'];
                  //$email = $_POST['email']; // ho già salvato la variabile email nella riga 18
                	$pwd = md5($_POST['password']);
                    $query = "insert into utenti
                    		  (nome_padrone,cognome_padrone,nome_cane,username,email,pwd)
                    		  values
                              ('$nome_padrone','$cognome_padrone','$nome_cane','$username','$email','$pwd')";
                    $result = mysql_query($query);
                	if ($result) {
                    	$query = "insert into utenti_fotoprofilo
                        		  (username) value ('$username')";
                    	if (mysql_query($query)) {
                        	mkdir("../users/$username/") or die("Errore nella creazione della cartella personale");
                            mkdir("../users/$username/foto-profilo") or die("Errore nella creazione della cartella foto-profilo");
                    		echo "<h1> Registration was successfull!</h1>
                        	 	  Welcome $nome_padrone $cognome_padrone, 
                             	  click <a href=../pagina-login/login.html>here</a> to login";
                    	}
                        else {
                        	echo "errore:" . mysql_error();
                        }
                    }
                    else echo "Could not insert query into database: " . mysql_error();
           		}
        	}
        ?>
    </body>
</html>