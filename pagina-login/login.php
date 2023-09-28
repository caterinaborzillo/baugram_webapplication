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
 			
 			if (!(isset($_POST['loginButton']))) {
            	header("Location: ../index.html");
            }
            else {
            	//controllo utente non registrato
            	$username = $_POST['username'];
                $query = "select username from utenti where username='$username'";
        		$result = mysql_query($query);
        		if (!($line=mysql_fetch_array($result,MYSQL_ASSOC))) {
 					echo "<h1> Sorry, you are not a registered user</h1>
                          <a href=../pagina-signup/signup.html> Click here to signup</a>";
                }
            	else {
                	$pwd = md5($_POST['password']);
                    $query = "select * from utenti where username='$username' and pwd='$pwd'";
                    $result = mysql_query($query);
                    if (!($line=mysql_fetch_array($result,MYSQL_ASSOC))) {
                    	echo "<h1> Sorry, the inserted password is wrong</h1>
                        	  <a href=login.html> Click here to login</a>";
                    }
                    else {
                        session_start();
                        $_SESSION['nome_padrone'] = $line['nome_padrone'];
                        $_SESSION['cognome_padrone'] = $line['cognome_padrone'];
                        $_SESSION['nome_cane'] = $line['nome_cane'];
                        $_SESSION['username'] = $line['username'];
                        $_SESSION['email'] = $line['email'];
                        $_SESSION['pwd'] = $line['pwd'];
                        $_SESSION['n_post'] = $line['n_post'];
                        $_SESSION['n_follower'] = $line['n_follower'];
                        $_SESSION['n_followed'] = $line['n_followed'];
                        $_SESSION['descrizione'] = $line['descrizione'];
                    	header("Location: ../pagina-profilo/profilo.php");
                    }
           		}
        	}
        ?>
    </body>
</html>