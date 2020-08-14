<?php


namespace Aigletter\Menu\Entities;


use Aigletter\Menu\Interfaces\MenuInterface;
use Aigletter\Menu\Interfaces\MenuItemInterface;

/**
 * Class MenuItem
 *
 * @package Aigletter\Menu\Entities
 */
class MenuItem implements MenuItemInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $attributes = [];

    //protected $children = [];

    /**
     * @var MenuInterface|null
     */
    protected $submenu;

    /**
     * MenuItem constructor.
     *
     * @param $id
     * @param $title
     * @param $url
     * @param array $attributes
     */
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

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $id
     */
    public function setId(string $id): void
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

    /*public function addChild(MenuItemInterface $item): void
    {
        $this->children[] = $item;
    }

    public function getChildren(): array
    {
        return $this->children;
    }*/

    public function setSubmenu(MenuInterface $submenu): void
    {
        $this->submenu = $submenu;
    }

    public function getSubmenu(): ?MenuInterface
    {
        return $this->submenu;
    }

    public function hasSubmenu(): bool
    {
        return isset($this->submenu);
    }
}