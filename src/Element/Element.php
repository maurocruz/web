<?php

namespace Plinct\Web\Element;

class Element implements ElementInterface {
    protected $element = [];

    public function __construct($tag = null, array $attributes = null, $content = null) {
        if ($tag) {
            $this->setElement($tag, $attributes, $content);
        }
    }

    public function getElement(): array {
        return $this->element;
    }

    protected function getLastElement(): int {
        $count = count($this->element);
        return $count == 0 ? 0 : $count - 1;
    }

    public function setElement(string $tagname, array $attributes = null, $content = null): ElementInterface {
        $this->element[]['tag'] = $tagname;
        if ($attributes) $this->addedInElement('attributes', $attributes);
        if ($content) $this->addedInElement('content', $content);
        return $this;
    }

    private function addedInElement(string $property, $value = null) {
        $newValue = null;
        $lastElement = $this->element[$this->getLastElement()][$property] ?? null;
        if ($lastElement) {
            if (is_string($lastElement)) {
                $newValue = [$lastElement, $value];
            } elseif (is_array($lastElement) && is_array($value)) {
                $lastElement[] = $value;
                $newValue = $lastElement;
            }elseif (is_array($lastElement) && is_string($value)) {
                $newValue = [ $lastElement, $value ];
            }
        } else {
            if (is_array($value) && array_key_first($value) !== 0 && $property === 'content') {
                $newValue = [ $value ];
            } else {
                $newValue = $value;
            }
        }
        // ADDED
        $this->element[$this->getLastElement()][$property] = $newValue;
    }

    public function attributes(array $attributes = null): ElementInterface {
        $currentAttributes = $this->element[$this->getLastElement()]['attributes'] ?? null;
        if ($attributes) {
            if (isset($currentAttributes)) {
                $this->element[$this->getLastElement()]['attributes'] = array_merge($currentAttributes,$attributes);
            } else {
                $this->addedInElement('attributes', $attributes);
            }
        }
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
        $this->element[$this->getLastElement()]['content'][] = ['tag'=>'div','attributes'=>$attributes];
        return $this;
    }

    public function p($content, array $attributes = null): ElementInterface {
        $this->element[$this->getLastElement()]['content'][] = ['tag'=>'p','attributes'=>$attributes,'content'=>$content];
        return $this;
    }

    public function h1($content, array $attributes = null): ElementInterface {
        $this->element[$this->getLastElement()]['content'][] = ['tag'=>'h1','attributes'=>$attributes,'content'=>$content];
        return $this;
    }

    public function ready(): array {
        return $this->element;
    }
}