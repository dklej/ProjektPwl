<div class="opcje">
    <div class="divlogo">
        <img src="photos/logo-logowanie.png" alt="logo">
    </div>
    <?php if ( admin_check( $_SESSION['login'] ) ) : ?>
        <div>
            <p> <a href="admin.php">Panel administratora</a> </p>
        </div>
    <?php endif; ?>
    <div>
            <p> <a href="forum.php">Strona główna</a> </p>
        </div>
    <div>
        <p> <a href="regulamin.html">Regulamin</a> </p>
    </div>
    <div class="plus">
        <img src="photos/plus.png" alt="plusik">  
        <a href="new-post.php">Dodaj post</a>
    </div>
    <div>
        <p><a href="logout.php"> Wyloguj </a></p>
    </div>
</div>