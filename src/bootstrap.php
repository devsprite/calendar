<?php

require ('../vendor/autoload.php');

function render(string $view, $params = [])
{
    extract($params);
    include ("../views/{$view}.php");
}

function dd(...$vars): void
{
    foreach ($vars as $var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

function get_pdo(): PDO
{
    return new PDO('mysql:host=localhost;dbname=tutocalendar', 'root', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

function h($string = null): string
{
    if($string === null) {
        return '';
    }
    return htmlentities($string);
}

function e404()
{
   require ('../public/404.php');
    exit;
}