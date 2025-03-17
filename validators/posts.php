<?php
function postValidate($email, $password) {
    if (!$email) {
        $_SESSION['errors']['email'] = 'Введите E-mail для входа';
    }
    
    if (!$password) {
        $_SESSION['errors']['password'] = 'Введите пароль для входа';
    }

    if ($_SESSION['errors']) {
        $_SESSION['old']['email'] = $email;
    return false;
    } 
    return true;
}

function createValidate($title, $content, $category_id, $messages) {
    if (!$title) {
        $_SESSION['errors']['title'] = $messages['title'];
    }
    if (!$content) {
        $_SESSION['errors']['content'] = $messages['content'];
    }
    if ($category_id < 1) {
        $_SESSION['errors']['category'] = $messages['category'];
    }
    if ($_SESSION['errors']) {
        $_SESSION['old'] = [
            'title' => $title,
            'content' => $content,
            'category_id' => $category_id,
    ];
    return false;
    }
    return true;
}

function saveValidate($title, $content, $category_id, $messages, $id) {
    if (!$title) {
        $_SESSION['errors']['title'] = $messages['title'];
    }
    if (!$content) {
        $_SESSION['errors']['content'] = $messages['content'];
    }
    if ($category_id < 1) {
        $_SESSION['errors']['category'] = $messages['category'];
    }
    if ($_SESSION['errors']) {
        $_SESSION['old'] = [
            'id' => $id,
            'title' => $title,
            'content' => $content,
            'category_id' => $category_id,
    ];
    return false;
    }
    return true;
}

function accountValidate($nickname, $email, $password) {
    if (!$nickname) {
        $_SESSION['errors']['nickname'] = 'Введите никнейм для регистрации';
    }
    
    if (!$email) {
        $_SESSION['errors']['email'] = 'Введите E-mail для регистрации';
    }
    
    if (!$password) {
        $_SESSION['errors']['password'] = 'Введите пароль для регистрации';
    }
    
    if ($_SESSION['errors']) {
        $_SESSION['old']['nickname'] = $nickname;
        $_SESSION['old']['email'] = $email;
    return false;
    } 
    return true;
}

function loginValidate($email, $password) {
    if (!$email) {
        $_SESSION['errors']['email'] = 'Введите E-mail для входа';
    }

    if (!$password) {
        $_SESSION['errors']['password'] = 'Введите пароль для входа';
    }

    if ($_SESSION['errors']) {
        $_SESSION['old']['email'] = $email;
    return false;
    } 
    return true;
}