<?php
require_once __DIR__ . '/src/Function.php';

$user = currentUser();
?>

<div class="avatar-container">
    <img class="avatar" src="<?php echo $user['avatar'] ?>" alt="<?php echo $user['name'] ?>">
    <div class="name"><?php echo $user['name'] ?></div>
</div>

<div>
    <form action="src/actions/ActionLogout.php" method="post">
        <div class="login-button">
            <button class="btn btn-outline-dark" role="button">Выйти</button>
        </div>
    </form>
</div>
