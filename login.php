<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Logowanie
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="login_style.css">
    </head>
    <body>
        <div class="loginbox">
            <img src="photos/logo-logowanie.png" class="logo" alt="logo">
            <h1>Panel logowania</h1>
            <form method="post">
                <p>Nazwa użytkownika</p>
                <input type="text" placeholder="Wpisz nazwę" name="login">
                <p>Hasło</p>
                <input type="password" placeholder="Wpisz hasło" name="pass"><br>   
                <input type="submit" value="Zaloguj" name="log_sub"><br><br>
                <p>Nie posiadasz konta?</p> <br>
                <a class="c-btn" href="register.php">Zarejestruj się</a><br>
            </form>
            <?php
                if ( isset( $_POST['log_sub'] ) ) {
                    if( !empty( $_POST['pass']) && !empty( $_POST['login'] ) ) { 
                        include( "conn.php" );
                        $req = $pdo->prepare("SELECT * FROM users where login = :login AND pass = :pass AND banned = :ban"); 
                        $banned_check = 0;
                        $req->bindParam(':login', $_POST['login'], PDO::PARAM_STR, 30);
                        $req->bindParam(':ban', $banned_check, PDO::PARAM_STR, 30);
                        $hash = hash('sha256', $_POST['pass']);
                        $req->bindParam(':pass', $hash, PDO::PARAM_STR, 64);
                        $req->execute();
                        $res = $req->rowCount();
                        if ( $res == 1 ) { 
                            $data = $req->fetchAll(); 
                            $_SESSION['login'] = $data[0]['login']; 
                            $_SESSION['password'] = $data[0]['pass']; 
                            $_SESSION['id'] = $data[0]['id_acc']; 
                            echo 'zalogowano';
                            header("Refresh:2; url=forum.php");
                        } else {
                            echo 'Bledne dane';
                        }
                    } else {
                        echo 'Uzupelnij pola';
                    }
                }
            ?>
        </div>     
    </body>
</html>
