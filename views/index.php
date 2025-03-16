<h1>Добро пожаловать в блог!</h1>

<div class="mt-4">
    <a href="/" class="btn btn-primary">Главная</a>
    <a href="/posts" class="btn btn-success">Посты</a>
    <a href="/register" class="btn btn-info">Регистрация</a>
    <a href="/login" class="btn btn-warning">Вход</a>
    <a href="/about" class="btn btn-info">About us</a>
</div>

<?php if (Authenticated()): ?>
    <p>Вы вошли как: <?= htmlspecialchars($_SESSION['nickname']) ?></p>
    <a href="/logout" class="btn btn-danger">Выйти</a>
<?php endif; ?>

<?php if (isset($_SESSION['messages'])): ?>
    <div class="alert alert-success">
        <?php foreach ($_SESSION['messages'] as $message): ?>
            <?= htmlspecialchars($message) ?><br>
        <?php endforeach; ?>
    </div>
    <?php unset($_SESSION['messages']); ?>
<?php endif; ?>