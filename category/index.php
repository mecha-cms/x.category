<?php

require __DIR__ . DS . 'engine' . DS . 'plug' . DS . 'from.php';
require __DIR__ . DS . 'engine' . DS . 'plug' . DS . 'page.php';
require __DIR__ . DS . 'engine' . DS . 'plug' . DS . 'to.php';

require __DIR__ . DS . 'engine' . DS . 'r' . DS . 'category.php';

$chops = explode('/', $url->path);
$category = array_pop($chops);
$prefix = array_pop($chops);

$GLOBALS['category'] = new Category;

if (
    $category &&
    '/' . $prefix === ($state->x->category->path ?? '/category') &&
    $file = File::exist([
        LOT . DS . 'category' . DS . $category . '.archive',
        LOT . DS . 'category' . DS . $category . '.page'
    ])
) {
    $category = new Category($file);
    // $category->page = null;
    $folder = LOT . DS . 'page' . implode(DS, $chops);
    if ($page = File::exist([
        $folder . '.archive',
        $folder . '.page'
    ])) {
        $category->parent = new Page($page);
    }
    $GLOBALS['category'] = $category;
    require __DIR__ . DS . 'engine' . DS . 'r' . DS . 'route.php';
}