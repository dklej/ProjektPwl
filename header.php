<?php include( 'func.php' ); ?>
<header>
    <ul>
        <?php if ( login() ) : ?> <li> <a href="forum.php">Przejdz do forum</a> </li> <?php endif; ?>
        <li> <a href="register.php">Zarejestruj</a> </li>
        <?php if ( login() ) : ?>
            <li> <a href="logout.php"><b>Wyloguj</b></a> </li>
        <?php else : ?>
            <li> <a href="login.php"><b>Zaloguj</b></a> </li>
        <?php endif; ?>
        
    </ul>
</header>
