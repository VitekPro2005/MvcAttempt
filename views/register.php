<form method="POST" action="/register">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <div class="mb-3">
        <label for="nickname" class="form-label">Nickname</label>
        <input type="text" class="form-control" id="nickname" name="nickname"
        value="<?= htmlspecialchars($_SESSION['old']['nickname'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email"
        value="<?= htmlspecialchars($_SESSION['old']['email'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
</form>