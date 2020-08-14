<?php


namespace Aigletter\Menu\Render;


use Aigletter\Menu\Entities\Menu;
use Aigletter\Menu\Html\HtmlElement;
use Aigletter\Menu\Interfaces\MenuInterface;
use Aigletter\Menu\Interfaces\MenuItemInterface;
use Aigletter\Menu\Interfaces\MenuRendererInterface;

class MenuHtmlRenderer implements MenuRendererInterface
{
    /**
     * @todo Move to config
     * @var array
     */
    protected $menuWrapper = [
        'tag' => 'ul',
        'attributes' => [],
    ];

    /**
     * @todo Move to config
     * @var array
     */
    protected $itemWrapper = [
        'tag' => 'li',
        'attributes' => [],
    ];

    /**
     * @todo Move to config
     * @var array
     */
    protected $submenuWrapper = [
        'tag' => 'ul',
        'attributes' => [
            'class' => 'submenu'
        ],
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

    public function setSubmenuWrapper(string $tagName, array $attributes = null)
    {
        $this->submenuWrapper = [
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

    public function render(MenuInterface $menu): string
    {
        $wrapperElement = $this->makeMenuElement($menu);

        return $wrapperElement->render();
    }

    /**
     * @todo refactoring parameter submenu
     *
     * @param MenuInterface $menu
     * @param bool $submenu
     *
     * @return HtmlElement
     */
    protected function makeMenuElement(MenuInterface $menu, $submenu = false)
    {
        $defaultAttributes = [];

        if (!$submenu) {
            $defaultAttributes['id'] = $menu->getName();
        } else {
            $defaultAttributes['class'] = $this->submenuWrapper['attributes']['class'] ?? 'submenu';
        }

        $menuElement = new HtmlElement(
            $this->menuWrapper['tag'],
            array_merge($defaultAttributes, $this->menuWrapper['attributes'])
        );

        foreach ($menu->getItems() as $item) {
            $itemElement = $this->makeItemElement($item);
            $menuElement->addChild($itemElement);
        }

        return $menuElement;
    }

    protected function makeItemElement(MenuItemInterface $item)
    {
        //$test = str_replace('_', '', ucwords($item->getId(), '_'));
        $attributes = $item->getAttributes();
        if (empty($attributes['id'])) {
            $attributes['id'] = strtolower(
                preg_replace(['/[A-Z]([A-Z](?![a-z]))*/', '/_/'], ['-$0', '-'], $item->getId())
            );
        }
        $itemElement = new HtmlElement(
            $this->itemWrapper['tag'],
            array_merge($this->itemWrapper['attributes'], $attributes),
        );
        $linkElement = new HtmlElement('a', array_merge([
            'href' => $item->getUrl()
        ], $this->linkAttributes));
        $linkElement->addText($item->getTitle());
        $itemElement->addChild($linkElement);

        if ($submenu = $item->getSubmenu()) {
            $submenuElement = $this->makeMenuElement($submenu, true);
            $itemElement->addChild($submenuElement);
            /*// TODO Add attributes
            $childrenWrapper = new HtmlElement(
                $this->submenuWrapper['tag'],
                $this->submenuWrapper['attributes']
            );
            foreach ($children as $child) {
                $childrenWrapper->addChild($this->makeItemElement($child));
            }
            $itemElement->addChild($childrenWrapper);*/
        }

        return $itemElement;
    }
}