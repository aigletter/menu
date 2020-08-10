<?php


namespace Aigletter\Menu\Test\Builder;


use Aigletter\Menu\Builder\MenuBuilder;
use PHPUnit\Framework\TestCase;

class MenuBuilderTest extends TestCase
{
    public function testAddItem()
    {
        $builder = new MenuBuilder();
        $builder->setName('test');
        $builder->addItem('Test', '/test');

        $menu = $builder->build();

        $this->assertCount(1, $menu->getItems());
    }
}