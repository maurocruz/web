<?php

namespace Plinct\Web\Element;

class Form extends Element {

    public function __construct(array $attributes = null, $content = null) {
        parent::__construct('form', $attributes, $content);
    }

    public function action(string $action): Form {
        $this->attributes(['action' => $action]);
        return $this;
    }

    public function method(string $method): Form {
        $this->attributes(['method'=>$method]);
        return $this;
    }

    public function input(string $name, string $value, string $type = 'text'): Form {
        $this->content(self::setInput($name, $value, $type));
        return $this;
    }
    
    public function fieldsetWithInput(string $name, string $value = null, string $legend = null, string $type = 'text', array $attributes = null ): Form {
        $this->content(self::setFieldset(self::setInput($name, $value, $type),$legend,$attributes));
        return $this;
    }

    public function fieldsetWithTextarea(string $name, string $value = null, string $legend = null, array $attributesFieldset = null, array $attributesTextarea = []): Form {
        $attributesTextarea['name'] =$name;
        $textArea = ['tag'=>'textarea','attributes'=>$attributesTextarea,'content'=>$value];
        $this->content(self::setFieldset($textArea,$legend,$attributesFieldset));
        return $this;
    }

    public function submitButtonSend(array $attributes = null): Form {
        $attributes['type'] = 'submit';
        $attributes['name'] = 'submit';
        $this->content(['tag'=>'button','attributes'=>$attributes,'content'=>'<span class="material-icons">send</span>']);
        return $this;
    }

    public function submitButtonDelete(string $formaction = null, array $attributes = []): Form {
        $attributes['type'] = 'submit';
        $attributes['name'] = 'submit';
        $attributes['onclick'] = "return confirm('"._("Are you sure you want to delete this item?")."');";
        if ($formaction) $attributes['formaction'] = $formaction;
        $this->content(['tag'=>'button','attributes'=>$attributes,'content'=>'<span class="material-icons">delete</span>']);
        return $this;
    }
    private static function setInput(string $name, string $value = null, string $type = 'text'): array {
        return ['tag'=>'input','attributes'=>['name'=>$name,'value'=>$value,'type'=>$type]];
    }

    private static function setFieldset($content, string $legend = null, array $attributes = null): array {
        $newContent[] = $legend ? ['tag'=>'legend','content'=>$legend] : null;
        $newContent[] = $content;
        return ['tag'=>'fieldset','attributes'=>$attributes,'content'=>$newContent];
    }
}