<?php


namespace Aigletter\Menu\Render;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Interfaces\MenuInterface;
use Aigletter\Menu\Interfaces\MenuItemInterface;
use Aigletter\Menu\Interfaces\MenuRendererInterface;

class MenuJsonRenderer implements MenuRendererInterface
{
    public function render(MenuInterface $menu): string
    {
        $array = $this->menuToArray($menu);

        return json_encode($array);
    }

    protected function menuToArray(MenuInterface $menu)
    {
        $array = [
            'name' => $menu->getName(),
        ];
        foreach ($menu->getItems() as $item) {
            $array['items'][] = $this->menuItemToArray($item);
        }

        return $array;
    }

    protected function menuItemToArray(MenuItemInterface $item)
    {
        $array = [
            'id' => $item->getId(),
            'title' => $item->getTitle(),
            'url' => $item->getUrl(),
        ];

        if ($submenu = $item->getSubmenu()) {
            $array['submenu'] = $this->menuToArray($submenu);
        }

        return $array;
    }
}