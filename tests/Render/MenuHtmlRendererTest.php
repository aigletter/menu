<?php


namespace Aigletter\Menu\Test\Render;


use Aigletter\Menu\Builder\MenuBuilder;
use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
//use Aigletter\Menu\MenuService;
use Aigletter\Menu\MenuService;
use Aigletter\Menu\Render\MenuHtmlRenderer;
//use Aigletter\Menu\Render\MenuUlRenderer;
use PHPUnit\Framework\TestCase;

class MenuHtmlRendererTest extends TestCase
{
    public function testRender()
    {
        $menu = new Menu('test');
        $menu->addItem(new MenuItem('test', 'Test', '/test'));

        $renderer = new MenuHtmlRenderer();

        $expected = '<ul id="test"><li id="test"><a href="/test">Test</a></li></ul>';
        $output = $this->clearHtml($renderer->render($menu));

        $this->assertEquals($expected, $output);
    }

    public function testChangeMarkup()
    {
        $service = new MenuService();
        $menu = $service->makeMenu('test', function (MenuBuilder $builder) {
            $builder->addItem('test', 'Test', '/test', ['id' => 'test', 'data-test' => 'test']);
        });

        $renderer = new MenuHtmlRenderer();
        $renderer->setMenuWrapper('div');
        $renderer->setItemWrapper('span', ['data-item' => 'item']);
        $renderer->setLinkAttributes(['class' => 'test-link']);

        $expected = $this->clearHtml('
            <div id="test">
                <span data-item="item" 
                            id="test" data-test="test">
                    <a href="/test" class="test-link">Test</a>
                </span>
            </div>
        ');

        $output = $this->clearHtml($renderer->render($menu));

        $this->assertEquals($expected, $output);
    }

    public function testRenderChildrenItems()
    {
        $menuItem = new MenuItem('testItem', 'Test Item', '/test-item');
        $submenu = new Menu('submenu');
        $submenu->addItem(new MenuItem('submenu-item', 'Submenu Item', '/submenu-item'));
        $menuItem->setSubmenu($submenu);
        //$menuItem->addChild(new MenuItem('testChild', 'Test Child', '/test-child'));
        $menu = new Menu('test');
        $menu->addItem($menuItem);

        $renderer = new MenuHtmlRenderer();

        $expected = $this->clearHtml('
            <ul id="test">
                <li id="test-item">
                    <a href="/test-item">Test Item</a>
                    <ul class="submenu">
                        <li id="submenu-item">
                            <a href="/submenu-item">Submenu Item</a>
                        </li>
                    </ul>
                </li>
            </ul>
        ');
        $output = $this->clearHtml($renderer->render($menu));

        $this->assertEquals($expected, $output);
    }

    protected function clearHtml($html)
    {
        return trim(preg_replace(["/\s{2,}/", "/(\>)[\s\n]*(\<)/m"], [' ', '$1$2'], $html));
    }
}