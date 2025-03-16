<?php
function getUserByToken($token)
{
    $statement = getDb()->prepare("SELECT id, nickname FROM users WHERE token = ?");
    $statement->execute([$token]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function createUser($nickname, $email, $password)
{
    $password = password_hash($password, PASSWORD_DEFAULT);
    $statement = getDb()->prepare("INSERT INTO users (nickname, email, password) values (?, ?, ?);");
    $statement->execute([$nickname, $email, $password]);
    return getDb()->lastInsertId();
}

function getUserByEmail($email)
{
    $statement = getDb()->prepare("SELECT id, nickname, password FROM users WHERE email=?");
    $statement->execute([$email]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function updateUserToken($user, $token)
{
    $statement = getDb()->prepare("UPDATE users SET token = ? WHERE id = ?");
    $statement->execute([$token, $user['id']]);
}

function clearUserToken($nickname)
{
    $statement = getDb()->prepare("UPDATE users SET token = NULL WHERE nickname = ?");
    $statement->execute([$nickname]);
}