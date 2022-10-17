<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

abstract class ElementAbstract implements ElementInterface
{
    /**
     * @var array
     */
    protected array $element = [];

    /**
     * @param string $tag
     */
    protected function setElement(string $tag): void
    {
        $this->element['tag'] = $tag;
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
	 * @param string $name
	 * @param string|null $value
	 * @return ElementInterface
	 */
    public function setAttribute(string $name, string $value = null): ElementInterface
    {
        $this->element['attributes'][$name] = $value;
        return $this;
    }

    /**
     * @param array|null $attributes
     * @return ElementInterface
     */
    public function attributes(array $attributes = null): ElementInterface
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
