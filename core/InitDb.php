<?php
function initDatabase($db)
{
    $db->query('CREATE TABLE IF NOT EXISTS `categories` (
        `id` INTEGER PRIMARY KEY,
        `title` VARCHAR NOT NULL
    );');

    $db->query('CREATE TABLE IF NOT EXISTS `posts` (
        `id` integer primary key,
        `title` VARCHAR NOT NULL,
        `content` TEXT NOT NULL,
        `category_id` INTEGER,
        FOREIGN KEY (category_id) REFERENCES categories(id)
    );');

    $db->query('CREATE TABLE IF NOT EXISTS `users` (
        `id` integer primary key,
        `nickname` VARCHAR NOT NULL,
        `email` VARCHAR NOT NULL,
        `password` VARCHAR NOT NULL,
        `token` VARCHAR
    );');

    $categories = $db->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($categories)) {
        $db->query("INSERT INTO categories (id, title) VALUES (1, 'Coding'), (2, 'Finance'), (3, 'Movies')");
    }

		$posts = $db->query("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($posts)) {
        $db->query("INSERT INTO posts (title, content, category_id) VALUES
            ('Тестовый пост', 'Содержимое поста', 2)");
    }
}