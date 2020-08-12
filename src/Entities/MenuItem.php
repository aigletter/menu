<?php


namespace Aigletter\Menu\Entities;


use Aigletter\Menu\Interfaces\MenuInterface;
use Aigletter\Menu\Interfaces\MenuItemInterface;

class MenuItem implements MenuItemInterface
{
    protected $id;

    protected $title;

    protected $url;

    protected $attributes = [];

    protected $children = [];

    protected $submenu;

    public function __construct($id, $title, $url, $attributes = [])
    {
        // TODO
        /*if (!isset($attributes['id'])) {
            $attributes['id'] = uniqid();
        }*/

        //$this->id = $attributes['id'];
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->attributes = $attributes;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function addChild(MenuItemInterface $item): void
    {
        $this->children[] = $item;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function setSubmenu(MenuInterface $submenu): void
    {
        $this->submenu = $submenu;
    }

    public function getSubmenu(): MenuInterface
    {
        return $this->submenu;
    }

    public function hasSubmenu(): bool
    {
        return isset($this->submenu);
    }
}