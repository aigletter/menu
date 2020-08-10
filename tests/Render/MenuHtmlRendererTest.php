<?php


namespace Aigletter\Menu\Test\Render;


use Aigletter\Menu\Builder\MenuBuilder;
use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
use Aigletter\Menu\MenuService;
use Aigletter\Menu\Render\MenuHtmlRenderer;
use Aigletter\Menu\Render\MenuUlRenderer;
use PHPUnit\Framework\TestCase;

class MenuHtmlRendererTest extends TestCase
{
    public function testRender()
    {
        $menu = new Menu('test', new MenuHtmlRenderer());
        $menu->addItem(new MenuItem('Test', '/test', ['id' => 'test']));

        $expected = '<ul id="test"><li id="test"><a href="/test">Test</a></li></ul>';
        $output = $this->clearHtml($menu->render());

        $this->assertEquals($expected, $output);
    }

    public function testMenuBuilderChangeMarkup()
    {
        $menuService = new MenuService();
        $menu = $menuService->makeMenu('test', function (MenuBuilder $builder) {
            $builder->setMenuWrapper('div');
            $builder->setItemWrapper('span', ['data-item' => 'item']);
            $builder->setLinkAttributes(['class' => 'test-link']);
            $builder->addItem('Test', '/test', ['id' => 'test', 'data-test' => 'test']);
        });

        $expected = $this->clearHtml('
            <div id="test">
                <span data-item="item" 
                            id="test" data-test="test">
                    <a href="/test" class="test-link">Test</a>
                </span>
            </div>
        ');
        $output = $this->clearHtml($menu->render());

        $this->assertEquals($expected, $output);
    }

    protected function clearHtml($html)
    {
        return trim(preg_replace(["/\s{2,}/", "/(\>)[\s\n]*(\<)/m"], [' ', '$1$2'], $html));
    }
}