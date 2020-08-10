<?php


namespace Aigletter\Menu\Builder;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
use Aigletter\Menu\Render\MenuHtmlRenderer;
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

    public function __construct()
    {
        // Default renderer
        $this->renderer = new MenuHtmlRenderer();
    }

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
     * @param array $attributes
     *
     * @return $this
     */
    public function addItem($title, $url, $attributes = [])
    {
        $this->items[] = [$title, $url, $attributes,];
        /*$item = new MenuItem($title, $url, $attributes);
        $this->items[$item->getId()] = $item;*/

        return $this;
    }

    /**
     * @return Menu
     */
    public function build()
    {
        $menu = new Menu($this->name, $this->renderer);
        foreach ($this->items as $item) {
            $menuItem = new MenuItem(...$item);
            $menu->addItem($menuItem);
            //$menu->addItem($item);
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
}