<?php include __DIR__ . '/../partials/errors.php'; ?>

<form method="POST" action="/posts/update">
    <input type="hidden" name="id" value="<?= $post['id'] ?? '' ?>">
    
    <div class="mb-3">
        <label>Название</label>
        <input type="text" name="title" class="form-control" 
               value="<?= htmlspecialchars($post['title'] ?? '') ?>">
    </div>
    
    <div class="mb-3">
        <label>Содержание</label>
        <textarea name="content" class="form-control" rows="5"><?= 
            htmlspecialchars($post['content'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label>Категория</label>
        <select name="category_id" class="form-control">
            <option value="">Выберите категорию</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" 
                    <?= ($post['category_id'] ?? 0) == $category['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['title']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>