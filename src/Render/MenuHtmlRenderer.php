<?php


namespace Aigletter\Menu\Render;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Html\HtmlElement;
use Aigletter\Menu\Interfaces\MenuRendererInterface;

class MenuHtmlRenderer implements MenuRendererInterface
{
    protected $menuWrapper = [
        'tag' => 'ul',
        'attributes' => [],
    ];

    protected $itemWrapper = [
        'tag' => 'li',
        'attributes' => [],
    ];

    protected $linkAttributes = [];

    /*public function __construct()
    {
        $this->menuWrapper = new HtmlElement('ul');
        $this->menuWrapper->addChild(new HtmlElement('li'));
    }*/

    /*public function setMenuWrapper($tagName, $attributes = [])
    {
        $children = $this->menuWrapper->getChildren();
        $wrapper = new HtmlElement($tagName, $attributes);
        foreach ($children as $child) {
            $wrapper->addChild($child);
        }
        $this->menuWrapper = $wrapper;
    }

    public function setItemWrapper($tagName, $attributes = []) {
        $children = $this->menuWrapper->getChildren();
        foreach ($children as $child) {
            $content = $child->getChildren();
        }
        $this->menuWrapper = new HtmlElement($tagName, $attributes);
    }*/

    /**
     * @todo
     *
     * @param string $tagName
     * @param array $attributes
     */
    public function setMenuWrapper(string $tagName, array $attributes = []): void
    {
        $this->menuWrapper = [
            'tag' => $tagName,
            'attributes' => $attributes,
        ];
    }

    /**
     * @todo
     *
     * @param string $tagName
     * @param array $attributes
     */
    public function setItemWrapper(string $tagName, array $attributes = []): void
    {
        $this->itemWrapper = [
            'tag' => $tagName,
            'attributes' => $attributes,
        ];
    }

    /**
     * @param array $linkAttributes
     */
    public function setLinkAttributes(array $linkAttributes): void
    {
        $this->linkAttributes = $linkAttributes;
    }

    public function render(Menu $menu): string
    {
        $wrapperElement = new HtmlElement($this->menuWrapper['tag'], array_merge([
            'id' => $menu->getName()
        ], $this->menuWrapper['attributes']));

        foreach ($menu->getItems() as $item) {
            $itemElement = new HtmlElement(
                $this->itemWrapper['tag'],
                array_merge($this->itemWrapper['attributes'], $item->getAttributes())
            );
            $linkElement = new HtmlElement('a', array_merge([
                'href' => $item->getUrl()
            ], $this->linkAttributes));
            $linkElement->addText($item->getTitle());
            $itemElement->addChild($linkElement);
            $wrapperElement->addChild($itemElement);
        }

        return $wrapperElement->render();
    }
}