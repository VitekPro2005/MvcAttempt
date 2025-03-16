<?php
require_once __DIR__ . '/../vendor/autoload.php';

$uri = isset($_SERVER['REQUEST_URI']) ? rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') : 'index';
$uri = ltrim($uri, '/');
$segments = explode('/', $uri);

$page = $segments[0] ?? 'index';
$subPage = $segments[1] ?? '';
$id = (int)$segments[2] ?? 0;


$_GET['route_action'] = match ($page) {
    'posts' => match ($subPage) {
        'create' => 'create',
        'edit' => 'update',
        'delete' => 'delete',
        'show' => 'show',
        default => 'posts'
    },
    'login' => 'login',
    'register' => 'register',
    'about' => 'about',
    'logout' => 'logout',
    'save' => 'save',
    default => $page
};

if (in_array($subPage, ['edit', 'post', 'delete'])) {
    $_GET['id'] = $id;
}