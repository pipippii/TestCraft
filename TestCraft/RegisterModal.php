<?php
require_once __DIR__ . '/src/Function.php';
?>

<div class="modal fade" id="registerModal" aria-hidden="true" aria-labelledby="terModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="src/actions/ActionRegister.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="registerModalLabel">Регистрация</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Введите фамилию и имя
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="Фамилия Имя"
                                value="<?php echo old('name') ?>"
                                <?php echo validationErrorAttr('name'); ?>
                            >
                            <?php if(hasValidationError('name')): ?>
                                <small><?php echo validationErrorMessage('name'); ?></small>
                            <?php endif; ?>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Введите электронную почту
                            <input
                                type="text"
                                id="email"
                                name="email"
                                class="form-control"
                                placeholder="E-mail"
                                value="<?php echo old('email') ?>"
                                <?php echo validationErrorAttr('email'); ?>
                            >
                            <?php if(hasValidationError('email')): ?>
                                <small><?php echo validationErrorMessage('email'); ?></small>
                            <?php endif; ?>
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="avatar" class="form-label">Загрузите изображение профиля
                            <input
                                type="file"
                                id="avatar"
                                name="avatar"
                                class="form-control"
                                <?php echo validationErrorAttr('avatar'); ?>
                            >
                            <?php if(hasValidationError('avatar')): ?>
                                <small><?php echo validationErrorMessage('avatar'); ?></small>
                            <?php endif; ?>
                        </label>
                    </div>

                    <div class="mb-3">
                        <div class="grid">
                            <label for="password" class="form-label">
                                Пароль
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="******"
                                    <?php echo validationErrorAttr('password'); ?>
                                >
                                <?php if(hasValidationError('password')): ?>
                                    <small><?php echo validationErrorMessage('password'); ?></small>
                                <?php endif; ?>
                            </label>

                            <label for="password_confirmation" class="form-label">
                                Подтверждение
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="******"
                                >
                            </label>
                        </div>
                    </div>

                    <fieldset>
                        <label class="form-check-label" for="terms">
                            <input
                                type="checkbox"
                                id="terms"
                                class="form-check-input"
                                name="terms"
                            >
                            Я принимаю все условия пользования
                        </label>
                    </fieldset>
                </div>
                <div class="modal-footer flex-column align-items-center gap-2 pb-3 border-top-0">
                    <button
                        type="submit"
                        id="submit"
                        class="btn btn-outline-dark w-100"
                    >
                        Продолжить
                    </button>
                    <p>У меня уже есть <a href="#loginModal" data-bs-toggle="modal" role="button">аккаунт</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
