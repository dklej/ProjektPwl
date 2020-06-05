<?php
session_start();
include( 'func.php' );
if ( !admin_check( $_SESSION['login'] ) ) exit;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administratora-statystyki</title>
    <link rel="stylesheet" href="admin_style.css" type="text/css">
</head>
<body>
    <div class="opcje">
        <p>
               --- ZBANOWANI UŻYTKOWNICY ---
        </p>
    
    </div>
    <div class="mainbox">
        <div class="posty">
            Aktywni uzytkownicy
            <?php
                include( "conn.php" );
                $req = $pdo->prepare("SELECT * FROM users WHERE banned = 1");
                $req->execute();
                $data = $req->fetchAll();
            ?>
            <table style="width:100%; text-align:center;">
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Akcja</th>
                </tr>
                <?php foreach ( $data as $user ) : ?>
                    <tr>
                        <td><?php echo $user['id_acc']; ?></td>
                        <td><?php echo $user['login']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><form method="post"><input type="submit" value="Odblokuj" name="user_<?php echo $user['id_acc']; ?>"></form></td>
                        <?php
                            if ( isset( $_POST['user_' . $user['id_acc'] ] ) ) {
                                $req_unban = $pdo->prepare("UPDATE users set banned = '0' WHERE id_acc = :id");
                                $req_unban->bindParam(':id', $user['id_acc'], PDO::PARAM_STR, 30);
                                $req_unban->execute();
                                header("Refresh:0; url=banned.php");
                            }
                        ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="opcjeAdmina"><br>
            <a href="banned.php"><p>Lista zablokowanych użytkowników</p></a><br>
            <a href="admin-post.php"><p>Przejdź do panelu dodawania postów</p></a><br>
            <a href="forum.php"><p>Strona główna (tablica)</p></a> <br>
        </div>
    </div>
    
</body>
</html>