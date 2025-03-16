<?php if (isset($_SESSION['errors'])): ?>
    <div class="alert alert-danger mb-3">
        <?php foreach ($_SESSION['errors'] as $error): ?>
            <?= htmlspecialchars($error) ?><br>
        <?php endforeach; ?>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>