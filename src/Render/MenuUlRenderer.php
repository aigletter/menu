<?php


namespace Aigletter\Menu\Render;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Interfaces\MenuRendererInterface;

class MenuUlRenderer implements MenuRendererInterface
{
    public function toHtml(Menu $menu)
    {
        $output = '<ul>';
        foreach ($menu->getItems() as $item) {
            $output .= '<li id="' . $item->getId() . '">';
            $output .= '<a href="' . $item->getUrl() . '">' . $item->getTitle() . '</a>';
            $output .= '</li>';
        }
        $output .= '</ul>';

        return $output;
    }
}