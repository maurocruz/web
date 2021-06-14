<?php

namespace Plinct\Web\Element;

class Element implements ElementInterface {
    private $element = [];

    public function getElement(): array {
        return $this->element;
    }

    private function getLastElement(): int {
        $count = count($this->element);
        return $count == 0 ? 0 : $count - 1;
    }

    private function addedInElement(string $property, $value = null) {
        $this->element[$this->getLastElement()][$property] = $value;
    }

    public function setElement(string $tagname, array $attributes = null, $content = null): ElementInterface {
        $this->element[]['tag'] = $tagname;
        $this->addedInElement('attributes', $attributes);
        $this->addedInElement('content', $content);
        return $this;
    }

    public function attributes(array $attributes = null): ElementInterface {
        if ($attributes) $this->addedInElement('attributes', $attributes);
        return $this;
    }

    public function content($content): ElementInterface {
        $this->addedInElement('content', $content);
        return $this;
    }

    public function href(string $href): ElementInterface {
        $this->addedInElement('href', $href);
        return $this;
    }

    public function div(array $attributes = null): ElementInterface {
        $this->setElement("div")->attributes($attributes);
        return $this;
    }

    public function p($content, array $attributes = null): ElementInterface {
        $this->setElement("p")->content($content)->attributes($attributes);
        return $this;
    }

    public function h1($content, array $attributes = null): ElementInterface {
        $this->setElement("h1")->content($content)->attributes($attributes);
        return $this;
    }

    public function ready(): array {
        return $this->element;
    }
}