<?php

ini_set('display_errors', '1');

use Aigletter\Menu\Builder\MenuBuilder;
use Aigletter\Menu\MenuService;

require '../vendor/autoload.php';

$service = new MenuService();

$menu = $service->makeMenu('top', function(MenuBuilder $builder) {
    $builder
        ->addItem('home', 'Home', '/')
        ->addItem('link', 'Link', '/link')
        ->addItem('dropdown', 'Dropdown', '/dropdown')
        ->addSubmenu('dropdown', function(MenuBuilder $builder) {
            $builder
                ->addItem('action', 'Action', '/action')
                ->addItem('another-action', 'Another action', '/another-action')
                ->addItem('something-else-here', 'Something else here', '/something-else-here');
        });
});

$renderer = new \Aigletter\Menu\Render\TemplateRenderer();
$renderer->setTemplate(realpath('../resources/bootstrap-navbar.php'));

?>

<html lang="en">
<head>
    <title>Bootstrap navs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
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