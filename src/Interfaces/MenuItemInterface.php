<?php


namespace Aigletter\Menu\Interfaces;


interface MenuItemInterface
{
    public function getTitle(): string;

    public function getUrl(): string;

    public function getAttributes(): array;

    public function addChild(MenuItemInterface $item): void;

    public function getChildren(): array;

    public function setSubmenu(MenuInterface $submenu): void;

    public function hasSubmenu(): bool;

    public function getSubmenu(): MenuInterface;
}
