<?php


namespace Aigletter\Menu\Entities;


use Aigletter\Menu\Interfaces\MenuInterface;
use Aigletter\Menu\Interfaces\MenuItemInterface;
use Aigletter\Menu\Interfaces\MenuRendererInterface;

class Menu implements MenuInterface
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
     * Menu constructor.
     *
     * @param string $name
     * @param MenuRendererInterface $renderer
     */
    public function __construct(string $name, MenuRendererInterface $renderer)
    {
        $this->name = $name;
        $this->renderer = $renderer;
    }

    /**
     * @param $title
     * @param $url
     * @param array $options
     *
     * @return MenuItemInterface
     */
    public function addItem(MenuItemInterface $item): void
    {
        $this->items[$item->getId()] = $item;
    }

    /**
     * @return MenuItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function render()
    {
        return $this->renderer->toHtml($this);
    }
}