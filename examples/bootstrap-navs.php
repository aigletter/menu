<?php

/**
 * Bootstrap navs
 */

use Aigletter\Menu\Builder\MenuBuilder;
use Aigletter\Menu\MenuService;
use Aigletter\Menu\Render\MenuHtmlRenderer;

require '../vendor/autoload.php';

$service = new MenuService();

$menu = $service->makeMenu('top', function(MenuBuilder $builder) {
    $builder
        ->addItem('one', 'One', '/one')
        ->addItem('two', 'Two', '/two');
});

//echo $menu->render();
$renderer = new MenuHtmlRenderer();
$renderer->setMenuWrapperConfig('ul', ['class' => 'nav']);
$renderer->setItemElementConfig('li', ['class' => 'nav-item']);
$renderer->setLinkElementAttributes(['class' => 'nav-link']);

?>

<html lang="en">
<head>
    <title>Bootstrap navs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php echo $renderer->render($menu); ?>
            </div>
        </div>
    </div>
</body>
</html>
