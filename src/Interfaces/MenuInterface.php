<?php


namespace Aigletter\Menu\Interfaces;


use Aigletter\Menu\Entities\MenuItem;

interface MenuInterface
{
    public function addItem(MenuItem $item): void;

    public function getItems(): array;

    /**
     * @todo
     *
     * @return string
     */
    public function render(): string;
}