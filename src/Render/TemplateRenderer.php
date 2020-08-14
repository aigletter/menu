<?php


namespace Aigletter\Menu\Render;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Interfaces\MenuInterface;
use Aigletter\Menu\Interfaces\MenuRendererInterface;

class TemplateRenderer implements MenuRendererInterface
{
    protected $template;

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function render(MenuInterface $menu): string
    {
        ob_start();

        include $this->template;

        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}