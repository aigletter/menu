<?php


namespace Aigletter\Menu;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Interfaces\MenuInterface;
use Aigletter\Menu\Builder\MenuBuilder;

class MenuService
{
    protected $menus = [];

    /**
     * @var MenuBuilder|null
     */
    protected $builder;

    /**
     * MenuService constructor.
     *
     * @param MenuBuilder|null $builder
     * @todo delete default value
     */
    public function __construct(MenuBuilder $builder = null)
    {
        // TODO delete
        if (empty($builder)) {
            $builder = new MenuBuilder();
        }

        $this->builder = $builder;
    }

    /**
     * @param $name
     * @param callable|null $callback
     *
     * @return MenuInterface
     */
    public function makeMenu($name, callable $callback = null): MenuInterface
    {
        $builder = $this->newBuilder();

        $builder->newMenu($name, $callback);

        $menu = $builder->getMenu();
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
    public function getMenus(): array
    {
        return $this->menus;
    }

    /**
     * @param $name
     * @param callable|null $callback
     *
     * @return MenuInterface
     */
    public function newBuilder(): MenuBuilder
    {
        $builder = clone $this->builder;

        return $builder;
    }
}