<?php


namespace Aigletter\Menu\Interfaces;


use Aigletter\Menu\Entities\MenuItem;

interface MenuInterface
{
    public function getName(): string;

    public function addItem(MenuItem $item): void;

    /**
     * @return MenuItemInterface[]
     */
    public function getItems(): array;

    public function getItem($id): ?MenuItemInterface;
}