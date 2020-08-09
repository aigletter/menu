<?php


namespace Aigletter\Menu;


use Aigletter\Menu\Builder\MenuBuilder;
use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Interfaces\MenuInterface;

class MenuService
{
    protected $menus = [];

    public function makeMenu($name, callable $callback = null): MenuInterface
    {
        $builder = new MenuBuilder();
        $builder->setName($name);

        if ($callback !== null) {
            $callback($builder);
        }

        $menu = $builder->build();
        $this->menus[$name] = $menu;

        return $menu;
    }

    public function getMenu($name)
    {
        return $this->menus[$name] ?? null;
    }

    public function getMenus()
    {
        return $this->menus;
    }
}