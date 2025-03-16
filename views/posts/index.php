    <div class="mb-4">
        <a href="/" class="btn btn-primary">На главную</a>
        <a href="/posts/create" class="btn btn-success">Создать новый пост</a>
    </div>
<?php foreach ($posts as $post): ?>
    <div class="card mt-4">
        <div class="card-header">
            <?= htmlspecialchars($post['title']) ?>
            <span class="badge bg-secondary"><?= htmlspecialchars($post['category_title']) ?></span>
            <a href="/posts/edit/<?= $post['id'] ?>" class="btn btn-warning">Изменить</a>
            <form method="POST" action="/posts/delete" class="d-inline">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        </div>
        <div class="card-body">
            <?= htmlspecialchars($post['content']) ?>
        </div>
    </div>
<?php endforeach; ?>