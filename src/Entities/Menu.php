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
    public function __construct(string $name, MenuRendererInterface $renderer = null)
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

    public function getItem($id): ?MenuItemInterface
    {
        return $this->items[$id] ?? null;
    }

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function render(): string
    {
        if ($this->renderer === null) {
            throw new \Exception('Renderer is not defined');
        }

        return $this->renderer->render($this);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}