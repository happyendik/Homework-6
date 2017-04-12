<?php
//require_once '.\vendor\autoload.php'; пути так не прописываются даже если windows
require 'vendor/autoload.php';
use Intervention\Image\ImageManager;

$manager = new ImageManager(array('driver' => 'gd'));
$watermark = $manager->make(__DIR__.'/img/pirat.png');

$manager->make(__DIR__.'/img/1.jpg')
        ->rotate(45, '#ffffff')
        ->insert($watermark->resize(500,500)->opacity(50), 'center-center')
        ->widen(200)
        ->save(__DIR__.'/img/2.jpg');

echo "<img src='/img/1.jpg'>";
echo '<hr>';
echo "<img src='/img/2.jpg'>";
