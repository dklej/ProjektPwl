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
            $req = $pdo->prepare("SELECT * FROM users INNER JOIN posts ON users.id_acc = posts.id_user");
            $req->execute();
            $data = $req->fetchAll();	
        ?>
        
        <table style="width:100%; text-align:center;">
            <tr>
                <th>Fotka</th>
                <th>Tytuł</th>
                <th>Autor</th>
                <th>Działanie</th>
            </tr>
            <?php foreach ( $data as $post ) { ?>
                <tr>
                    <td><img style="max-width: 350px; max-height: 400px; border-size: 1px; border-color: black; border-style: solid;" src="uploads/<?php echo $post['url'] ?>"></td>
                    <?php
                        if($post['id_user'] == $_SESSION['id']) { 
                            echo '<form method="post" enctype="multipart/form-data">';
                            echo '<td><input type="text" name="inputTitle" value="'.$post['title'].'"></td>';
                        } else {
                            echo '<td>'.$post['title'].'</td>';
                        }

                        echo '<td>'.$post['login'].'</td>';

                        if($post['id_user'] == $_SESSION['id']) {
                            echo '<input type="hidden" name="idPost" value="'.$post['id_post'].'">';
                            echo '<td><input type="submit" name="editPicture" value="Edytuj" style="all: unset;"></td>';
                            echo '</form>';
                        } else {
                            echo '<td>Brak uprawnień</td>';
                        }
                    ?>                  
                </tr>
                <tr>
                    <td colspan="4">
                        <?php
                            include( "conn.php" );
                            $req = $pdo->prepare("SELECT * FROM comments INNER JOIN users ON users.id_acc = comments.comment_author_id WHERE comments.comment_post_id = ".$post['id_post']);
                            $req->execute();
                            $dataComment = $req->fetchAll();
                            print_r($req->error);    
                        ?>
                        <b>Komentarze</b>
                        <?php echo $req->num_rows; ?>
                        <hr>
                        <table>
                            <?php #if($req->num_rows > 0) { ?>
                            <?php foreach ( $dataComment as $row ) { ?>
                            <tr>
                                <td><b><?php echo $row['login']; ?></b></td>
                                <td><?php echo $row['comment_text']; ?></td>
                            </tr>
                            <?php } #} ?>
                            <tr>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="postID" value="<?php echo $post['id_post']; ?>">
                                    <input type="text" name="inputComment">
                                    <input type="submit" name="addComment" value="Wyślij" style="all: unset;" placeholder="Treść komentarza...">
                                </form>
                            </tr>
                        </table>    
                    </td>
                </tr>
            <?php } ?>
            <?php 
                // EDIT PICTURE
                if ( !empty( $_POST['editPicture'] ) ) {
                    if(!empty($_POST['inputTitle'])) {

                        $title  = $_POST['inputTitle'];
                        $idPost = $_POST['idPost'];
                                
                                
                        include( "conn.php" );
            
                        $req = $pdo->prepare( "UPDATE posts SET title = :title WHERE id_post = :idPost" );
                        $req->bindParam( ':title', $title, PDO::PARAM_STR, 30 );
                        $req->bindParam( ':idPost', $idPost, PDO::PARAM_STR, 30 );
                        $req->execute();
            
                        echo 'Edytowano pomyslnie';
                        #echo '$idPost = '.$idPost.', $title = '.$title; //DEBUG
                        header("Refresh:2; url=forum.php");
                    } else {
                        echo 'Wypełnij pola';
                    }
                }

                // ADD COMMENT
                if ( !empty( $_POST['addComment'] ) ) {
                    if(!empty($_POST['inputComment'])) {

                        $comment = $_POST['inputComment'];  
                        $postID  = $_POST['postID'];

                        $mysql_host = 'mysql1.ugu.pl';
                        $port = '';
                        $username = 'db697848';
                        $password = 'qwertyuio';
                        $database = 'db697848'; 

                        $conn = mysqli_connect($mysql_host, $username, $password, $database);
                        if(!$conn) {
                            die('Połączenie odrzucone: '.mysqli_connect_error());
                        }             

                        $sql = 'INSERT INTO comments (comment_post_id, comment_author_id, comment_date, comment_text) VALUES ("'.$postID.'", "'.$_SESSION['id'].'", "2", "'.$comment.'")';   
                        $result = mysqli_query($conn, $sql);               
                        ?>
                        <script type="text/javascript">
                            window.location.href="http://dawidklej.ugu.pl/forum.php";
                        </script>
                        <?php
                    } else {
                        echo 'Uzupełnij treść komentarza';
                    }
                }
            ?>
        </table>
    
    </div>
    
</body>
</html>