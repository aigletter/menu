<?php


namespace Aigletter\Menu\Test\Render;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
use Aigletter\Menu\Render\MenuJsonRenderer;
use PHPUnit\Framework\TestCase;

class MenuJsonRendererTest extends TestCase
{
    public function testRender()
    {
        $menu = new Menu('test');
        $menu->addItem(new MenuItem('first', 'First', '/first'));

        $item = new MenuItem('second', 'Second', '/second');
        $submenu = new Menu('submenu');
        $submenu->addItem(new MenuItem('submenu-item', 'Submenu Item', '/submenu-item'));
        $item->setSubmenu($submenu);
        $menu->addItem($item);

        $renderer = new MenuJsonRenderer();

        $expected = json_encode([
            'name' => 'test',
            'items' => [
                [
                    'id' => 'first',
                    'title' => 'First',
                    'url' => '/first',
                ],
                [
                    'id' => 'second',
                    'title' => 'Second',
                    'url' => '/second',
                    'submenu' => [
                        'name' => 'submenu',
                        'items' => [
                            [
                                'id' => 'submenu-item',
                                'title' => 'Submenu Item',
                                'url' => '/submenu-item',
                            ]
                        ]
                    ]
                ]
            ]
        ]);
        $output = $renderer->render($menu);

        $this->assertEquals($expected, $output);
    }
}