<?php
session_start();
if (!function_exists('Authenticated')) {
    function Authenticated() {
        return isset($_SESSION['nickname']);
    }
}

$messages = [
    'default' => '',
    'create' => 'Пост создан',
    'update' => 'Пост изменен',
    'delete' => 'Пост удален',
    'title' => 'Заголовок не может быть пустым',
    'content' => 'Содержание не может быть пустым',
    'category' => 'Категория не может быть пустой',
    'post' => 'Пост не существует',
    'auth' => 'Для выполнения действия необходимо авторизоваться'
];
$method = $_SERVER['REQUEST_METHOD'];

$errors = [];
$db = getDb();
initDatabase($db);

switch ($routeAction) {
    case 'about':
        $phone = '+7 913 118-28-85';
        render('about', ['phone' => $phone]);
        break;    
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nickname = trim($_POST['nickname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (!accountValidate($nickname, $password, $email)) {
                header('Location: /register');
                exit;
            }
                createUser($nickname, $email, $password);

            $_SESSION['messages'][] = 'Вы успешно зарегистрировались';

            unset($_SESSION['old']);

            header('Location: /');
            exit;
        } else {
            render('register');
        }
    break;

    case 'login':
        if ($method === 'POST') {        
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $remember = isset($_POST['remember']);

            if (!loginValidate($email, $password)) {
                header('Location: /login');
                exit;
            }
            $user = getUserByEmail($email);

        if (password_verify($password, $user['password'])) {
            $_SESSION['nickname'] = $user['nickname'];
            $_SESSION['messages'][] = 'Вы успешно вошли';
        if ($remember) {
            $randomToken = bin2hex(random_bytes(32));
            $expires = time() + 3600;
    
            updateUserToken($user, $token);
    
            setcookie('token', $randomToken, $expires, '/');
        }
    
        unset($_SESSION['old']);
    
        header('Location: /');
        exit;
    } else {
        $_SESSION['errors'][] = 'Не удалось войти (неверный логин или пароль)';
        unset($_SESSION['old']);
    
        header('Location: /login');
        exit;
    }
    } else {
    render('login');
    }
    break;    
    case 'logout':
        if (isset($_SESSION['nickname'])) {
            clearUserToken($_SESSION['nickname']);
        }
    
        setcookie('token', '', time() - 3600, '/');
        session_destroy();
        header('Location: /');
        exit;
        break;

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $category_id = (int)($_POST['category_id'] ?? 0);

            if (!createValidate($title, $content, $category_id, $messages)) {
                header('Location: /create');
                exit();
            }
            createPost($title, $content, $category_id);
    
            $_SESSION['messages'][] = $messages['create'];
            header('Location: /posts');
            exit();
        } else {
            $categories = getAllCategories();
            render('posts/create', [
                'categories' => $categories,
                'post' => [
                    'title' => '',
                    'content' => '',
                    'category_id' => 0
                ]
            ]);
        }
        break;
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $category_id = (int)$_POST['category_id'] ?? 0;

            if (!saveValidate($title, $content, $category_id, $messages, $id)) {
                header("Location: /posts/edit/$id");
                exit;
            }

            updatePost($title, $content, $category_id, $id);
            $_SESSION['messages'][] = $messages['update'];
            header('Location: /posts');
            exit;
        } else {
            $id = (int)$_GET['id'] ?? 0;
            $post = getPost($id);
        
            if (!$post) {
                $_SESSION['errors'][] = $messages['post'];
                header('Location: /posts');
                exit;
            }
        
            $categories = getAllCategories();
            render('posts/edit', [
                'post' => $post,
                'categories' => $categories
            ]);
        }
        break;
    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)($_POST['id'] ?? 0);

        $post = getPost($id);
    
        if (!$post) {
            $_SESSION['errors'][] = $messages['post'];
            header('Location: /posts');
            exit;
        } else {
            $statement = $db->prepare("DELETE FROM posts WHERE id = ?");
            $statement->execute([$id]);
            $_SESSION['messages'][] = $messages['delete'];
            header('Location: /posts');
            exit();
        }
        break;
        }   
    case 'posts':
        render('posts/index', ['posts' => getAllposts()]);
        break;  
    default:
            unset($_SESSION['messages']);
            render('index');
            exit;
        $viewFile = __DIR__ . '/../views/' . $routeAction . '.php';
        if (file_exists($viewFile)) {
            render($routeAction);
        } else {
            http_response_code(404);
            render('404');
        }
        break;
}