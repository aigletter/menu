<?php


namespace Aigletter\Menu\Interfaces;


interface MenuRendererInterface
{
    public function render(MenuInterface $menu): string;
}