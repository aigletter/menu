<?php


namespace Aigletter\Menu\Test\Entities;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
use Aigletter\Menu\Render\MenuUlRenderer;
use PHPUnit\Framework\TestCase;
use Aigletter\Menu\Render\MenuHtmlRenderer;

class MenuTest extends TestCase
{
    public function testAddItem()
    {
        $menu = new Menu('test', new MenuHtmlRenderer());
        $item = new MenuItem('Test', 'hello');
        $menu->addItem($item);

        $this->assertCount(1, $menu->getItems());
    }

    /*public function testUlRenderWithAttributes()
    {
        $menu = new Menu('test', new MenuUlRenderer());
        $menu->addItem(new MenuItem('Test', '/test', [
            'id' => 'test',
            'class' => 'hello'
        ]));

        $expected = '<ul><li id="test" class="hello"><a href="/test">Test</a></li></ul>';
        $output = str_replace("\n", '', $menu->render());

        $this->assertEquals($expected, $output);
    }*/

    /*public function testDirRenderer()
    {
        $menu = new Menu('test', new MenuDirRenderer());
        $menu->addItem(new MenuItem('Test', '/test', ['id' => 'test']));

        $expected = '<div><div id="test"><a href="/test">Test</a></div></div>';
        $output = str_replace("\n", '', $menu->render());

        $this->assertEquals($expected, $output);
    }*/
}
