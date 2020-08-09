<?php


namespace Aigletter\Menu\Builder;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
use Aigletter\Menu\Render\MenuUlRenderer;
use Aigletter\Menu\Interfaces\MenuRendererInterface;

class MenuBuilder
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var MenuRendererInterface
     */
    protected $renderer;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param $name
     * @param $title
     * @param $url
     * @param array $options
     *
     * @return $this
     */
    public function addItem($name, $title, $url, $options = [])
    {
        $this->items[$name] = new MenuItem($name, $title, $url, $options);

        return $this;
    }

    /**
     * @return Menu
     */
    public function build()
    {
        $renderer = $this->renderer ?? new MenuUlRenderer();

        $menu = new Menu($this->name, $renderer);
        foreach ($this->items as $item) {
            //$menuItem = new MenuItem($item['name'], $item['title'], $item['url'], $item['options']);
            //$menu->addItem($menuItem);
            $menu->addItem($item);
        }

        return $menu;
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
}