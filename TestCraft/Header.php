<?php require_once __DIR__ . '/src/Function.php'; ?>

<nav class="navbar navbar-expand-lg shadow-sm mb-5 bg-white rounded">
    <div class="container-fluid">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-3 d-flex">
                    <img class="header-logo" src="logotip.svg" alt="">
                </div>

                <div class="collapse navbar-collapse col-6" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="gap:150px">
                        <li class="nav-item">
                            <a class="nav-link active" href="Main.php">Главная</a>
                        </li>
                        <li class="nav-item">
                            <?php if (checkIsAuth()) : ?>
                                <a class="nav-link active" href="ListTests.php">Создать тест</a>
                            <?php else : ?>
                                <a class="nav-link active" href="#loginModal" data-bs-toggle="modal" data-bs-target="#loginModal">Создать тест</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php if (checkIsAuth()) : ?>
                                <a class="nav-link active" href="Passing.php">Пройти тест</a>
                            <?php else : ?>
                                <a class="nav-link active" href="#loginModal" data-bs-toggle="modal" data-bs-target="#loginModal">Пройти тест</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>

                <div class="col-3 d-flex align-items-center justify-content-end" style="gap:15px;">
                    <?php
                    if (checkIsAuth()) {
                        include_once __DIR__ . '/Account.php';
                    } else {
                        echo '<div>
                                <a class="btn btn-outline-dark px-4" data-bs-toggle="modal" data-bs-target="#loginModal" role="button">Войти</a>
                            </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>