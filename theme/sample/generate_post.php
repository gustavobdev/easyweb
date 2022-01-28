<?php

require __DIR__ . "/../../vendor/autoload.php";

use Faker\Provider\Image;
use Faker\Provider\Lorem;
use Source\Models\Post;

for ($i = 0;$i < 40; $i++){
    $post = new Post();
    $post->title = Lorem::text(80);
    $post->cover = Image::image("imagens", 300, 150);
    $post->description = Lorem::paragraphs(2,true);
    $post->save();
    var_dump($post);
}