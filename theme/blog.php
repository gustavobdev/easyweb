<?php

require __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Paginator\Paginator;
use Source\Models\Post;

$post = new Post();
$page = filter_input(INPUT_GET,"page",FILTER_SANITIZE_STRIPPED);


$paginator = new Paginator("http://localhost/blog/?page=", "Página", ["Primeira Página", "Primeira"], ["Última Página", "Última"]);
$paginator->pager($post->find()->count(), 10, $page,2);


$posts = $post->find()->limit($paginator->limit())->offset($paginator->offset())->fetch(true);

echo "<p>Página {$paginator->page()} de {$paginator->pages()}</p>";

if ($posts){
    foreach ($posts as $post){
        echo "<article class='post'><h1>{$post->title}</h1> <img src='{$post->cover}' /> <p>{$post->description}</p></article>";
    }
}

echo $paginator->render("paginator");