<?php


namespace Aigletter\Menu\Test\Entities;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
use PHPUnit\Framework\TestCase;

class MenuItemTest extends TestCase
{
    public function testMenuItemSubmenu()
    {
        $item = new MenuItem('test', 'Test', '/test');
        $item->setSubmenu(new Menu('submenu'));

        $this->assertTrue($item->hasSubmenu());
    }
}