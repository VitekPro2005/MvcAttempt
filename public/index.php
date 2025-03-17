<?php
require_once __DIR__ . '/../vendor/autoload.php';
$uri = isset($_SERVER['REQUEST_URI']) ? rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') : 'index';
$uri = ltrim($uri, '/');
$segments = explode('/', $uri);

$page = !empty($segments[0]) ? $segments[0] : 'index';
$subPage = $segments[1] ?? '';
$id = (int)($segments[2] ?? 0);
echo $segments[0];

$routeAction = match ($page) {
    'posts' => match ($subPage) {
        'create' => 'create',
        'update' => 'update',
        'delete' => 'delete',
        'show' => 'show',
        default => 'posts'
    },
    'login' => 'login',
    'register' => 'register',
    'about' => 'about',
    'logout' => 'logout',
    'index' => 'default',
    default => $page
};
if (in_array($subPage, ['update', 'post', 'delete'])) {
    $_GET['id'] = $id;
}
require_once __DIR__ . '/../core/controller.php';