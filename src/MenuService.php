<?php


namespace Aigletter\Menu;


use Aigletter\Menu\Builder\MenuBuilder;
use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Interfaces\MenuInterface;

class MenuService
{
    protected $menus = [];

    /**
     * @param $name
     * @param callable|null $callback
     *
     * @return MenuInterface
     */
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

    /**
     * @param $name
     *
     * @return Menu
     */
    public function getMenu($name): Menu
    {
        return $this->menus[$name] ?? null;
    }

    /**
     * @return array
     */
    public function getMenus()
    {
        return $this->menus;
    }
}