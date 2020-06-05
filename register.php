<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Logowanie</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="login_style.css">
    </head>
    <body>  
        <div class="loginbox">
            <img src="photos/logo-logowanie.png" class="logo" alt="logo">
            <h1>Rejestracja</h1>
            <form method="POST">
                <p>Nazwa użytkownika</p>
                <input type="text" placeholder="Wpisz nazwę" name="login">
                <p>Adres e-mail</p>
                <input type="text" placeholder="Wpisz e-mail" name="email">
                <p>Hasło</p>
                <input type="password" placeholder="Wpisz hasło" name="pass"><br>   
                <input type="submit" value="Zarejestruj" name="register"><br><br>
            </form>
            <?php
                if ( isset( $_POST['register'] ) ) {
                    if ( !empty( $_POST['pass'] ) && !empty( $_POST['login'] ) && !empty( $_POST['email'] ) ) { 
                        include( 'conn.php' );
                        $result = $pdo->prepare( "SELECT login, email FROM users WHERE login = :login OR email = :email" ); 
                        $result->bindParam( ':login', $_POST['login'], PDO::PARAM_STR, 30 );
                        $result->bindParam( ':email', $_POST['email'], PDO::PARAM_STR, 30 );
                        $result->execute();
                        $number_of_rows = $result->rowCount();
                        if( $number_of_rows < 1 ) {
                            $sth = $pdo->prepare( "INSERT INTO users VALUES ('', :email, :login, :pass, '', '')" ); 
                            $hash = hash( 'sha256', $_POST['pass'] ); 
                            $sth->bindParam( ':pass', $hash, PDO::PARAM_STR, 64 );
                            $sth->bindParam( ':login', $_POST['login'], PDO::PARAM_STR, 30 );
                            $sth->bindParam( ':email', $_POST['email'], PDO::PARAM_STR, 30 );
                            $sth->execute();
                            echo 'zarejestrowano';
                            header("Refresh:2; url=forum.php");
                        } else {
                            echo 'Dane sa zajete'; 
                        }
                    } else {
                        
                        echo 'Wpisz dane';
                    }
                }
            ?>
        </div> 
    </body>
</html>
