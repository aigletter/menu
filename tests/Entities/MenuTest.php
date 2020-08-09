<?php


namespace Aigletter\Menu\Test\Entities;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
use Aigletter\Menu\Render\MenuUlRenderer;
use PHPUnit\Framework\TestCase;

class MenuTest extends TestCase
{
    public function testAddItem()
    {
        $menu = new Menu('test', new MenuUlRenderer());
        $item = new MenuItem('test', 'Test', 'hello');
        $menu->addItem($item);

        $this->assertCount(1, $menu->getItems());
    }

    public function testRender()
    {
        $menu = new Menu('test', new MenuUlRenderer());
        $menu->addItem(new MenuItem('test', 'Test', '/test'));

        $expected = '<ul><li id="test"><a href="/test">Test</a></li></ul>';
        $output = str_replace("\n", '', $menu->render());

        $this->assertEquals($expected, $output);
    }
}