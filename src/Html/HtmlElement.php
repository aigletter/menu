<?php


namespace Aigletter\Menu\Html;


class HtmlElement
{
    /**
     * @var HtmlElement[]
     */
    protected $children = [];

    /**
     * @var string
     */
    //protected $content;

    /**
     * @var array
     */
    protected $attributes = [];

    public function __construct($tagName, $attributes = [])
    {
        $this->tagName = $tagName;
        $this->attributes = $attributes;
    }

    /**
     * @param HtmlElement|string $child
     */
    public function addChild(HtmlElement $child): void
    {
        $this->children[] = $child;
    }

    /**
     * @todo
     *
     * @param string $text
     */
    public function addText(string $text)
    {
        $this->children[] = $text;
    }

    public function render(): string
    {
        $output = "<{$this->tagName}" . $this->attributesToString() . ">";

        foreach ($this->children as $child) {
            if ($child instanceof HtmlElement) {
                $content = $child->render();
            } else {
                $content = $child;
            }

            $output .= $content;
        }

        $output .= "</{$this->tagName}>";

        return $output;
    }

    /**
     * @param $attributes
     *
     * @return string
     */
    protected function attributesToString()
    {
        $output = '';
        foreach ($this->attributes as $key => $value) {
            $output .= ' ' . $key . '="' . $value . '"';
        }
        return $output;
    }

    public function getChildren()
    {
        return $this->children;
    }

    /*public function setContent(string $content)
    {
        $this->content = $content;
    }*/

    /**
     * @return string
     */
    //abstract function render(): string ;
}