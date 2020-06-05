<?php
function login() { 
    if ( !empty( $_SESSION['login'] ) && !empty( $_SESSION['password']) && !empty( $_SESSION['id'] ) )  { 
        return true;
    } else {
        return false;
    }
}

function admin_check( $login ) {
    include( "conn.php" );
    $req = $pdo->prepare("SELECT rank FROM users where login = :login");
    $req->bindParam(':login', $login, PDO::PARAM_STR, 30);
    $req->execute();
    $res = $req->fetchAll();
    if ( $res[0]['rank'] == 1) {
        return true;
    } else {
        return false;
    }
}
?>