<?php

/**
 * Bootstrap nav
 */

use Aigletter\Menu\Builder\MenuBuilder;
use Aigletter\Menu\MenuService;

require '../vendor/autoload.php';

$service = new MenuService();

//$menu = $service->makeMenu('top', function(MenuBuilder $builder) {
$menu = MenuBuilder::makeMenu('top', function(MenuBuilder $builder) {
    $builder
        ->setMenuWrapper('ul', ['class' => 'nav'])
        ->setItemWrapper('li', ['class' => 'nav-item'])
        ->setLinkAttributes(['class' => 'nav-link']);
    $builder
        ->addItem('One', '/one')
        ->addItem('Two', '/two');
});

echo $menu->render();