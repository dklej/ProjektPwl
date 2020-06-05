<?php
session_start();
include( 'func.php' );
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="forum_style.css" type="text/css">
</head>
<body>
    <?php include( 'header-forum.php' ); ?>
    <div class="mainbox">
    <br>
        <?php
            include( "conn.php" );
            $req = $pdo->prepare("SELECT users.login, posts.url, posts.title FROM users INNER JOIN posts ON users.id_acc = posts.id_user");
            $req->execute();
            $data = $req->fetchAll();	
        ?>
        
        <table style="width:100%; text-align:center;">
            <tr>
                <th>Fotka</th>
                <th>Tytuł</th>
                <th>Autor</th>
            </tr>
            <?php foreach ( $data as $post ) : ?>
                <tr>
                    <td><img src="uploads/<?php echo $post['url'] ?>"></td>
                    <td><?php echo $post['title']; ?></td>
                    <td><?php echo $post['login']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    
    </div>
    
</body>
</html>