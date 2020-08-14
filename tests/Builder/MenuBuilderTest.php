<?php


namespace Aigletter\Menu\Builder\Test;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Builder\MenuBuilder;
use PHPUnit\Framework\TestCase;

class MenuBuilderTest extends TestCase
{
    public function testMakeMenu()
    {
        $menu = MenuBuilder::instance()->newMenu('test')->getMenu();

        $this->assertInstanceOf(Menu::class, $menu);
    }



    public function testAddItem()
    {
        $builder = new MenuBuilder();
        $builder->newMenu('test');
        $builder->addItem('test', 'Test', '/test');

        $menu = $builder->getMenu();

        $this->assertCount(1, $menu->getItems());
    }

    public function testAddSubmenu()
    {
        $builder = new MenuBuilder();
        $builder->newMenu('test');
        $builder->addItem('test', 'Test', '/test')
            ->addSubmenu('submenu');
        $menu = $builder->getMenu();

        $this->assertTrue($menu->getItem('test')->hasSubmenu());
    }

    public function testSubmenuWithCallback()
    {
        $builder = new MenuBuilder();
        $builder->newMenu('test', function(MenuBuilder $builder){
            $builder->addItem('test', 'Test', '/test');
            $builder->addSubmenu('submenu', function(MenuBuilder $builder){
                $builder->addItem('submenuItemOne', 'Submenu Item One', '/submenu-item-one');
                $builder->addItem('submenuItemTwo', 'Submenu Item Two', '/submenu-item-two');
            });
        });

        $menu = $builder->getMenu();

        $this->assertCount(2, $menu->getItem('test')->getSubmenu()->getItems());
    }
}