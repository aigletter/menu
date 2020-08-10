<?php


namespace Aigletter\Menu\Interfaces;


use Aigletter\Menu\Entities\Menu;

interface MenuRendererInterface
{
    public function render(Menu $menu): string;
}