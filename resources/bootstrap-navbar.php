<?php

/**
 * @var \Aigletter\Menu\Entities\Menu $menu
 */

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!--<a class="navbar-brand" href="#">Navbar</a>-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" id="<?php echo $menu->getName() ?>">
            <?php foreach ($menu->getItems() as $item): ?>
                <li class="nav-item <?php echo $item->hasSubmenu() ? 'dropdown' : '' ?>" id="<?php $item->getId() ?>">
                    <?php if ($item->getSubmenu()): ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $item->getTitle() ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($item->getSubmenu()->getItems() as $submenuItem): ?>
                                <a class="dropdown-item" href="<?php echo $submenuItem->getUrl() ?>">
                                    <?php echo $submenuItem->getTitle() ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <a class="nav-link" href="<?php echo $item->getUrl() ?>">
                            <?php echo $item->getTitle() ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>
