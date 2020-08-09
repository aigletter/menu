<?php


namespace Aigletter\Menu\Interfaces;


use Aigletter\Menu\Entities\Menu;

interface MenuRendererInterface
{
    public function toHtml(Menu $menu);
}