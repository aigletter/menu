<?php


namespace Aigletter\Menu\Test;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\MenuService;
use PHPUnit\Framework\TestCase;

class MenuServiceTest extends TestCase
{
    public function testMakeMenu()
    {
        $service = new MenuService();
        $menu = $service->makeMenu('test');

        $this->assertInstanceOf(Menu::class, $menu);
    }

    public function testGetMenu()
    {
        $service = new MenuService();
        $service->makeMenu('test');

        $menu = $service->getMenu('test');

        $this->assertInstanceOf(Menu::class, $menu);
    }

    public function testGetMenus()
    {
        $service = new MenuService();
        $service->makeMenu('test');

        $this->assertCount(1, $service->getMenus());
    }
}