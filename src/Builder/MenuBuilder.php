<?php


namespace Aigletter\Menu\Builder;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
use Aigletter\Menu\Interfaces\MenuInterface;
use Aigletter\Menu\Interfaces\MenuItemInterface;
use Aigletter\Menu\Render\MenuHtmlRenderer;
use Aigletter\Menu\Interfaces\MenuRendererInterface;

class MenuBuilder
{
    /**
     * @var MenuInterface
     */
    protected $menu;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var MenuRendererInterface
     */
    protected $renderer;

    static public function instance()
    {
        return new self();
    }

    /*static function __callStatic($name, $arguments)
    {
        if (method_exists(static::class, $name)) {
            return self::instance()->{$name}($arguments);
        }

        throw new \Exception('Unknown method ' . $name);
    }*/

    public function __construct()
    {
        // Default renderer
        // TODO
        $this->renderer = new MenuHtmlRenderer();
    }

    public function __clone()
    {
        $this->reset();
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function newMenu(string $name, callable $callback = null)
    {
        // TODO
        $this->menu = new Menu($name, $this->renderer);

        if ($callback !== null) {
            $callback($this);
        }

        return $this;
    }

    /**
     * @param $name
     * @param $title
     * @param $url
     * @param array $attributes
     *
     * @return $this
     */
    public function addItem($id, $title, $url, $attributes = [])
    {
        //$this->items[] = [$id, $title, $url, $attributes,];
        $item = new MenuItem($id, $title, $url, $attributes);
        $this->menu->addItem($item);
        //$this->items[$item->getId()] = $item;

        return $this;
    }

    /**
     * @return MenuInterface
     */
    public function getMenu()
    {
        return $this->menu;
        /*$menu = new Menu($this->name, $this->renderer);
        foreach ($this->items as $item) {
            $menuItem = new MenuItem(...$item);
            $menu->addItem($menuItem);
            //$menu->addItem($item);
        }

        self::$menus[$this->name] = $menu;

        return $menu;*/
    }

    /**
     * @param MenuRendererInterface $renderer
     *
     * @return MenuBuilder
     */
    public function setRenderer(MenuRendererInterface $renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }

    /**
     * @todo
     *
     * @param $tagName
     * @param array $attributes
     *
     * @return MenuBuilder
     */
    public function setMenuWrapper($tagName, $attributes = [])
    {
        $this->renderer->setMenuWrapper($tagName, $attributes);

        return $this;
    }

    /**
     * @todo
     *
     * @param $tagName
     * @param array $attributes
     *
     * @return MenuBuilder
     */
    public function setItemWrapper($tagName, $attributes = [])
    {
        $this->renderer->setItemWrapper($tagName, $attributes);

        return $this;
    }

    /**
     * @todo
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function setLinkAttributes(array $attributes)
    {
        $this->renderer->setLinkAttributes($attributes);

        return $this;
    }

    public function addSubmenu(string $itemId, string $submenuName, callable $callback = null)
    {
        $builder = new self();
        $builder->newMenu($submenuName, $callback);
        $submenu = $builder->getMenu();

        $this->menu->getItem($itemId)->setSubmenu($submenu);

        return $this;
    }

    public function reset()
    {
        $this->menu = null;
    }
}