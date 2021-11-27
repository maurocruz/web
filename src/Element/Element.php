<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

class Element extends ElementAbstract implements ElementInterface
{
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

}
