<?php


namespace Aigletter\Menu\Entities;


use Aigletter\Menu\Interfaces\MenuInterface;
use Aigletter\Menu\Interfaces\MenuItemInterface;
use Aigletter\Menu\Interfaces\MenuRendererInterface;

/**
 * Class Menu
 *
 * @package Aigletter\Menu\Entities
 */
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

    protected $parent;

    /**
     * Menu constructor.
     *
     * @param string $name
     * @param MenuRendererInterface $renderer
     */
    public function __construct(string $name, ?MenuItemInterface $parent = null)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * @param $title
     * @param $url
     *
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

    /**
     * @param $id
     *
     * @return MenuItemInterface|null
     */
    public function getItem($id): ?MenuItemInterface
    {
        return $this->items[$id] ?? null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function isSubmenu()
    {
        return isset($this->parent);
    }

    public function getParent()
    {
        return $this->parent;
    }
}
