<html>
    <head>
        <title>Baugram - Edit Profile</title>
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
        <link rel="stylesheet" href="editProfile.css"/>

        <!-- Importo le mie funzioni per questo form -->
        <script type="text/javascript" lang="javascript" src="editProfile.js"></script>
        
        <!-- Importo libreria per icone -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>

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
        ?>
        <ul>
            <li><i class="fas fa-home"></i></li>
            <li><i class="fas fa-paw"></i></li>
            <li><a href="../profilo.php"><i class="fas fa-dog"></i></a></li>
            <li style="float: right; padding-top: 10px; padding-right: 10px;">
                <label for="searchtext"><i class="fas fa-search"></i></label>
                <input type="text" id="searchtext" size="25" placeholder="Search">
            </li>
        </ul>
        <h1 class="animated infinite pulse">EDIT PROFILE</h1>
        <div class="centerzone">
            <form action="editProfileCTRL.php" name="editProfileForm" class="form-edit" method="POST" enctype="multipart/form-data" onsubmit="return checkEditProfile();">
                <div class="label">If you want to change your profile photo:</div>
                <input type="file" name="fotoProfilo" class="form-control animated bounceInLeft"/>
                <br>
                <div class="label">If you want to change your personal data:</div>
                <?php
                	echo "<input type=text name=nomePadrone class=form-control animated bounceInRight placeholder='Owner name' value=" . $_SESSION['nome_padrone'] . " autofocus required><br>
                    	  <input type=text name=cognomePadrone class=form-control animated bounceInLeft placeholder='Owner last name' value=" . $_SESSION['cognome_padrone'] . " required><br>
                          <input type=text name=nomeCane class=form-control animated bounceInRight placeholder='Dog name' value=" . $_SESSION['nome_cane'] . " required><br>
                          <input type=text name=username class=form-control animated bounceInLeft placeholder='Username' value=" . $_SESSION['username'] . " required><br>
                          <input type=text name=email class=form-control animated bounceInRight placeholder='Email' value=" . $_SESSION['email'] . " required><br>
                          <div class=label>If you want to change your description:</div>
                          <textarea rows=4 name=descrizione class=form-control animated bounceInLeft placeholder='Description'>" . $_SESSION['descrizione'] . "</textarea><br>";
                ?>
                <div class="label">If you want to change your password:</div>
                <input type="password" name="oldPassword" class="form-control animated bounceInRight" placeholder="Old password">
                <br>
                <input type="password" name="newPassword" class="form-control animated bounceInLeft" placeholder="New password"/>
                <br>
                <input type="password" name="newPasswordConfirm" class="form-control animated bounceInRight" placeholder="Re-type new password"/>
                <br>
                <table class="animated bounceInLeft">
                    <tr>
                        <td><button name="saveButton" class="btn btn-lg btn-danger btn-length" type="submit">SAVE</button></td>
                        <td><button name="resetButton" class="btn btn-lg btn-secondary btn-length" type="reset">RESET</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>