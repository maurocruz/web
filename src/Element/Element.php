<?php
namespace Plinct\Web\Element;

class Element implements ElementInterface {
    protected $element = [];

    public function __construct($tag, array $attributes = null, $content = null) {
        $this->element['tag'] = $tag;
        if ($attributes) $this->element['attributes'] = $attributes;
        if ($content) $this->element['content'] = $content;
    }

    protected function withObject(): Element {
        $this->element['object'] = $this->element['tag'];
        unset($this->element['tag']);
        return $this;
    }

    public function content($content): ElementInterface {
        $this->element['content'][] = $content;
        return $this;
    }

    public function setAttribute($name,$value): ElementInterface {
        $this->element['attributes'][$name] = $value;
        return $this;
    }

    public function attributes(array $attributes): ElementInterface {
        if (isset($this->element['attributes'])) {
            $this->element['attributes'] = array_merge($this->element['attributes'],$attributes);
        } else {
            $this->element['attributes'] = $attributes;
        }
        return $this;
    }

    public function href(string $href): ElementInterface {
        $this->element['href'] = $href;
        return $this;
    }

    public function ready(): array {
        return $this->element;
    }
}