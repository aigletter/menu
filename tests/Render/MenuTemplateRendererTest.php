<?php


namespace Aigletter\Menu\Test\Render;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Entities\MenuItem;
use Aigletter\Menu\Render\TemplateRenderer;
use PHPUnit\Framework\TestCase;

class MenuTemplateRendererTest extends TestCase
{
    public function testTemplateRender()
    {
        $menu = new Menu('test');
        $menu->addItem(new MenuItem('first', 'First', '/first'));

        $item = new MenuItem('second', 'Second', '/second');
        $submenu = new Menu('submenu');
        $submenu->addItem(new MenuItem('submenu-item', 'Submenu Item', '/submenu-item'));
        $item->setSubmenu($submenu);
        $menu->addItem($item);

        $renderer = new TemplateRenderer();
        $template = realpath('resources/bootstrap-navbar.php');
        $renderer->setTemplate($template);

        $output = $renderer->render($menu);

        $this->assertStringContainsString('<nav', $output);
    }
}