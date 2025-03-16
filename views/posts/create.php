<?php include __DIR__ . '/../partials/errors.php'; ?>

<form method="POST" action="/posts/create">
    <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" name="title" 
               value="<?= htmlspecialchars($_SESSION['old']['title'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Содержание</label>
        <textarea class="form-control" id="content" name="content" rows="5"><?= 
            htmlspecialchars($_SESSION['old']['content'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Категория</label>
        <select class="form-control" id="category_id" name="category_id">
            <option value="">Выберите категорию</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= 
                    ($_SESSION['old']['category_id'] ?? 0) == $category['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['title']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Создать</button>
</form>