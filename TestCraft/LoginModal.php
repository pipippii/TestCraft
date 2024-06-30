<div class="modal fade" id="loginModal" aria-hidden="true" aria-labelledby="loginModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="src/actions/ActionLogin.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="loginModalLabel">Вход в систему</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if(hasMessage('error')): ?>
                        <div class="notice error"><?php echo getMessage('error') ?></div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <input
                            type="text"
                            id="email"
                            class="form-control"
                            name="email"
                            placeholder="Введите e-mail"
                            value="<?php echo old('email') ?>"
                            <?php echo validationErrorAttr('email'); ?>
                        >
                        <?php if(hasValidationError('email')): ?>
                            <small><?php echo validationErrorMessage('email'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <input
                            type="password"
                            id="password"
                            class="form-control"
                            name="password"
                            placeholder="Введите пароль"
                        >
                    </div>
                </div>
                <div class="modal-footer flex-column align-items-center gap-2 pb-3 border-top-0">
                    <button
                        type="submit"
                        id="submit"
                        class="btn btn-outline-dark w-100"
                    >
                        Войти
                    </button>
                    <p>У меня еще нет <a href="#registerModal" data-bs-toggle="modal" role="button">аккаунта</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
