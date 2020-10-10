<?php


namespace Aigletter\Menu\Builder;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
use Aigletter\Menu\Interfaces\MenuInterface;
use Aigletter\Menu\Render\MenuHtmlRenderer;
use Aigletter\Menu\Interfaces\MenuRendererInterface;

/**
 * Class MenuBuilder
 *
 * @package Aigletter\Menu\Builder
 */
class MenuBuilder
{
    /**
     * @var MenuInterface
     */
    protected $menu;

    /**
     * @var MenuRendererInterface
     */
    protected $renderer;

    /**
     * @return MenuBuilder
     */
    static public function instance(): MenuBuilder
    {
        return new self();
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     *
     * @throws \Exception
     */
    static function __callStatic($name, $arguments)
    {
        if (method_exists(static::class, $name)) {
            return self::instance()->{$name}($arguments);
        }

        throw new \Exception('Unknown method ' . $name);
    }

    /**
     * MenuBuilder constructor.
     */
    public function __construct()
    {
        // Default renderer
        // TODO delete
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
        $this->menu = new Menu($name);

        if ($callback !== null) {
            $callback($this);
        }

        return $this;
    }

    /**
     * @param string $name
     * @param string $title
     * @param string $url
     * @param array $attributes
     *
     * @return $this
     */
    public function addItem(string $id, string $title, string $url, array $attributes = [])
    {
        $item = new MenuItem($id, $title, $url, $attributes);
        $this->menu->addItem($item);

        return $this;
    }

    /**
     * @return MenuInterface
     */
    public function getMenu(): MenuInterface
    {
        return $this->menu;
    }

    /**
     * @param MenuRendererInterface $renderer
     *
     * @return MenuBuilder
     */
    /*public function setRenderer(MenuRendererInterface $renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }*/

    /**
     * @todo
     *
     * @param $tagName
     * @param array $attributes
     *
     * @return MenuBuilder
     */
    public function setMenuWrapper(string $tagName, array $attributes = [])
    {
        $this->renderer->setMenuWrapperConfig($tagName, $attributes);

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
    /*public function setItemWrapper(string $tagName, array $attributes = [])
    {
        $this->renderer->setItemElementConfig($tagName, $attributes);

        return $this;
    }*/

    /**
     * @todo
     *
     * @param array $attributes
     *
     * @return $this
     */
    /*public function setLinkAttributes(array $attributes)
    {
        $this->renderer->setLinkElementAttributes($attributes);

        return $this;
    }*/

    /**
     * @param string $itemId
     * @param string $submenuName
     * @param callable|null $callback
     *
     * @return $this
     */
    public function addSubmenu(string $submenuName, callable $callback = null, string $itemId = null)
    {
        $builder = new self();
        $builder->newMenu($submenuName, $callback);
        $submenu = $builder->getMenu();

        if ($itemId === null) {
            $itemId = array_key_last($this->menu->getItems());
        }

        $this->menu->getItem($itemId)->setSubmenu($submenu);

        return $this;
    }

    /**
     *
     */
    public function reset()
    {
        $this->menu = null;
    }
}