<?php


namespace Aigletter\Menu\Test;


use Aigletter\Menu\Html\HtmlElement;
use PHPUnit\Framework\TestCase;

class HtmlElementTest extends TestCase
{
    public function testHtmlElement()
    {
        $element = new HtmlElement('div', ['id' => 'test', 'class' => 'test']);
        $span = new HtmlElement('span', ['id' => 'hello', 'class' => 'hello']);
        $span->addText('Hello world');
        $element->addChild($span);

        $expected = '<div id="test" class="test"><span id="hello" class="hello">Hello world</span></div>';
        $output = str_replace("\n", '', $element->render());

        $this->assertEquals($expected, $output);
    }
}