<?php


namespace Aigletter\Menu\Interfaces;


interface MenuItemInterface
{
    public function getTitle(): string;

    public function getUrl(): string;

    public function getAttributes(): array;
}
