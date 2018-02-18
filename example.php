<?php
require 'easypdo.php';

$a = new EasyPDO();
$a->connect('localhost', 'birebirilgi', 'root', '');
$b = $a->table('nav');
$b->cols=array('name');
$b->where="name LIKE '%Ders%'";
$c=$b->select();
foreach ($c as $item) {
    echo $item['name'];echo '<br>';
}
