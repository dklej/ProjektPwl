<?php
session_start();
include( 'func.php' );
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Dodawanie posta</title>
        <link rel="stylesheet" href="forum_style.css" type="text/css">
    </head>
    <body>
        <?php include( 'header-forum.php' ); ?>
        <div class="mainbox">
            <h1>Dodaj post</h1>
            <p>Uzupełnij pola danymi:</p>
            <form method="post" enctype="multipart/form-data">
                <input type="text" placeholder="Wpisz tytuł zdjęcia" class="tytul" name="title"><br>
                <input type="file" class="plik" name="image"><br>
                <input type="submit" value="Dodaj post" name="add_img">
            </form>
            <?php
                if ( isset( $_POST['add_img'] ) ) {
                    if ( !empty( $_POST['title'] ) && ($_FILES['image']['size'] != 0) ) {

                        
                        $fileTmpPath    = $_FILES['image']['tmp_name'];
                        $fileName       = $_FILES['image']['name'];
                        $uploadFileDir  = './uploads/';
                        $dest_path      = $uploadFileDir . $fileName;
                        
                        if ( move_uploaded_file( $fileTmpPath, $dest_path ) ) {
                            include( "conn.php" );
                            $req = $pdo->prepare( "INSERT INTO posts VALUES ('', :id_acc, :title, :url)" );
                            $req->bindParam( ':id_acc', $_SESSION['id'], PDO::PARAM_STR, 30 );
                            $req->bindParam( ':title', $_POST['title'], PDO::PARAM_STR, 30 );
                            $req->bindParam( ':url', $_FILES['image']['name'], PDO::PARAM_STR, 30 );
                            $req->execute();
                            
                            echo 'Dodano pomyslnie';
                            header("Refresh:2; url=forum.php");
                        } else {
                            echo 'Error uploadu';
                            echo 'fileTmpPath: '.$fileTmpPath.'<br>';
                            echo 'fileName: '.$fileName.'<br>';
                            echo 'dest_path: '.$dest_path.'<br>';

                        }
                    } else {
                        echo 'Wypelnij pola';
                    }
                }
            ?>
        </div>
    </body>
</html>
