<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

class Element implements ElementInterface
{
    /**
     * @var array
     */
    protected array $element = [];

    /**
     * @param $tag
     * @param array|null $attributes
     * @param null $content
     */
    public function __construct($tag, array $attributes = null, $content = null)
    {
        $this->element['tag'] = $tag;
        if ($attributes) $this->element['attributes'] = $attributes;
        if ($content) $this->element['content'] = $content;
    }

    /**
     * @return $this
     */
    protected function withObject(): Element
    {
        $this->element['object'] = $this->element['tag'];
        unset($this->element['tag']);
        return $this;
    }

    /**
     * @param $content
     * @return ElementInterface
     */
    public function content($content): ElementInterface
    {
        $this->element['content'][] = $content;
        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return ElementInterface
     */
    public function setAttribute($name,$value): ElementInterface
    {
        $this->element['attributes'][$name] = $value;
        return $this;
    }

    /**
     * @param array $attributes
     * @return ElementInterface
     */
    public function attributes(array $attributes): ElementInterface
    {
        if (isset($this->element['attributes'])) {
            $this->element['attributes'] = array_merge($this->element['attributes'],$attributes);
        } else {
            $this->element['attributes'] = $attributes;
        }
        return $this;
    }

    /**
     * @param string $href
     * @return ElementInterface
     */
    public function href(string $href): ElementInterface
    {
        $this->element['href'] = $href;
        return $this;
    }

    /**
     * @return array
     */
    public function ready(): array
    {
        return $this->element;
    }
}
