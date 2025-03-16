<?php
function getPost($id)
{
    $statement = getDb()->prepare("SELECT * FROM posts WHERE id = ?");
    $statement->execute([$id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function getAllposts() {
    $statement = getDb()->query('SELECT posts.*, categories.title as category_title FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id ORDER BY posts.id DESC');
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function getAllCategories() {
  return getDb()->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
}
function createPost($title, $content, $category_id) {
    $statement = getDb()->prepare("INSERT INTO posts (title, content, category_id) VALUES (?, ?, ?)");
    $statement->execute([$title, $content, $category_id]);
}
function updatePost($title, $content, $category_id, $id) {
    $statement = getDb()->prepare("UPDATE posts SET title = ?, content = ?, category_id = ? WHERE id = ?");
    $statement->execute([$title, $content, $category_id, $id]);    
}