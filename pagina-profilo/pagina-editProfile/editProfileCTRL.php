<html>
    <head></head>
    <body>
        <?php
            include_once("../../libraries/mysql-fix.php");
            include_once("../../libraries/myfunctions.php");
            $host = "localhost";
            $user = "baugram";
            $pass = "Baugram2020";
            $db = "my_baugram";
            connectToDB($host, $user, $pass, $db);
            session_start();

            if (!(isset($_POST['saveButton']))) {
            	header("Location: ../../index.html");
            }
            // Verifico eventuali problemi nell'upload del file
            if (!isset($_FILES['fotoProfilo']) || !is_uploaded_file($_FILES['fotoProfilo']['tmp_name'])) {
                echo 'Non hai inviato nessun file...';  
            }

            $upload_dir = "../../users/" . $_SESSION['username'] . "/foto-profilo/";
            $tipi_file_corretti = array("image/jpeg","image/jpg","image/png");
            $file_tmp_name = $_FILES['fotoProfilo']['tmp_name'];
            $file_name = $_FILES['fotoProfilo']['name'];
            $file_type = $_FILES['fotoProfilo']['type'];
            //controllo che il formato sia corretto, .jpeg/.jpg/.png
            if (in_array($file_type,$tipi_file_corretti)) {
                $image = addslashes(file_get_contents($file_tmp_name));
           	 	// invio l'immagine nel DB
            	$query = "update utenti_fotoprofilo set
            		  	  nome_file = '$file_name',
                      	  tipo_file = '$file_type',
                      	  foto = '$image'
                      	  where username = '" . $_SESSION['username'] . "'";
                mysql_query($query) or die ("errore nell'inserimento dell'immagine nel DB: " . mysql_error());
                // inserisco immagine nella server directory users/username/foto-profilo/
                move_uploaded_file($file_tmp_name, $upload_dir . $file_name) or die("Upload non valido!");
            }
            else {
                header("Location: editProfile.php");
            	echo "Picture is not uploaded because of wrong format. Please select format .jpeg/.jpg/.png";
            }
            
            // setto i campi dei campi personali dell'utente
            $nome_padrone = $_POST["nomePadrone"];
            $cognome_padrone = $_POST["cognomePadrone"];
            $nome_cane = $_POST["nomeCane"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $descrizione = $_POST["descrizione"];
            $query = "update utenti set
                      nome_padrone = '$nome_padrone',
                      cognome_padrone = '$cognome_padrone',
                      nome_cane = '$nome_cane',
                      username = '$username',
                      email = '$email',
                      descrizione = '$descrizione'
                      where username = '" . $_SESSION['username'] . "'";
            mysql_query($query) or die("errore nella query durante l'inserimento dei dati personali" . mysql_error());
            if ($_SESSION['username'] != $username) {
            	rename("../../users/" . $_SESSION['username'], "../../users/$username") or die("Errore nel renaming della cartella server");
                $query = "update utenti_fotoprofilo set username='$username' where username='" . $_SESSION['username'] . "'";
            	mysql_query($query) or die("errore durante il renaming della tabella fotoprofilo: " . mysql_error());
			}
            
            //setto la nuova password
            $old_pwd = md5($_POST["oldPassword"]);
            $new_pwd = md5($_POST["newPassword"]);
            $new_pwd_confirm = md5($_POST["newPasswordConfirm"]);
            $query = "select pwd from utenti where username='$username' and pwd='$old_pwd'";
            $result = mysql_query($query);
            if (!($line=mysql_fetch_array($result,MYSQL_ASSOC))) echo "Old password is wrong!";
            else {
                if ($new_pwd != $new_pwd_confirm) echo "New passwords are not the same!";
                else {
                    $query = "update utenti set pwd='$new_pwd' where username='$username'";
                    mysql_query($query) or die("error in changing password:" . mysql_error());
                }
            }
            $_SESSION['nome_padrone'] = $nome_padrone;
            $_SESSION['cognome_padrone'] = $cognome_padrone;
      		$_SESSION['nome_cane'] = $nome_cane;
      		$_SESSION['username'] = $username;
      		$_SESSION['email'] = $email;
            $_SESSION['pwd'] = $new_pwd;  
            $_SESSION['descrizione'] = $descrizione;  		
            header("Location: ../profilo.php");
        ?>
    </body>
</html>