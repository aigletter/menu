<?php


namespace Aigletter\Menu\Interfaces;


interface MenuItemInterface
{
    public function getId(): string;

    public function getTitle(): string;

    public function getUrl(): string;

    public function getAttributes(): array;

    //public function addChild(MenuItemInterface $item): void;

    //public function getChildren(): array;

    public function hasSubmenu(): bool;

    public function getSubmenu(): ?MenuInterface;


    // TODO delete

    public function setTitle(string $title): void;

    public function setId(string $id): void;

    public function setUrl(string $url): void;

    public function setSubmenu(MenuInterface $submenu): void;
}
