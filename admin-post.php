<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administratora</title>
    <link rel="stylesheet" href="admin_style.css" type="text/css">
</head>
<body>
    <div class="opcje">
        <p>
               --- POSTY UŻYTKOWNIKÓW DO DODANIA ---
        </p>
    
    </div>
    <div class="mainbox">
        <div class="posty">
            Miejsce na posty
            <?php
                include( "conn.php" );
                $req = $pdo->prepare("SELECT * FROM posts");
                $req->execute();
                $data = $req->fetchAll();
            ?>
            <table style="width:100%; text-align:center;">
                <tr>
                    <th>ID</th>
                    <th>tytuł</th>
                    <th>plik</th>
                    <th>Akcja</th>
                </tr>
                <?php foreach ( $data as $post ) : ?>
                    <tr>
                        <td><?php echo $post['id_post']; ?></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['url']; ?></td>
                        <td><form method="post"><input type="submit" value="Usuń" name="post_<?php echo $post['id_post']; ?>"></form></td>
                        <?php
                            if ( isset( $_POST['post_' . $post['id_post'] ] ) ) {
                                $req_del = $pdo->prepare("DELETE FROM posts WHERE id_post = :id");
                                $req_del->bindParam(':id', $post['id_post'], PDO::PARAM_STR, 30);
                                $req_del->execute();
                                header("Refresh:0; url=admin-post.php");
                            }
                        ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="opcjeAdmina"><br>
            <a href="new-post.php"><p>Dodaj post</p></a> <br>
            <a href="forum.php"><p>Strona główna (tablica)</p></a> <br>
        </div>
    </div>
    
</body>
</html>