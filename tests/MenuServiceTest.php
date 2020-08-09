<?php


namespace Aigletter\Menu\Test;


use Aigletter\Menu\Builder\MenuBuilder;
use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\MenuService;
use PHPUnit\Framework\TestCase;

class MenuServiceTest extends TestCase
{
    public function testMakeMenu()
    {
        $menuService = new MenuService();
        $menu = $menuService->makeMenu('test');

        $this->assertInstanceOf(Menu::class, $menu);
    }

    public function testGetMenu()
    {
        $menuService = new MenuService();
        $menuService->makeMenu('test');

        $menu = $menuService->getMenu('test');

        $this->assertInstanceOf(Menu::class, $menu);
    }

    public function testMenuBuilder()
    {
        $menuService = new MenuService();
        $menu = $menuService->makeMenu('test', function(MenuBuilder $builder) {
            $builder->addItem('test', 'Test', '/test');
        });

        $this->assertCount(1, $menu->getItems());
    }
}