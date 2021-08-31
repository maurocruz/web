<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

class Form extends Element
{
    /**
     * @param array|null $attributes
     * @param null $content
     */
    public function __construct(array $attributes = null, $content = null)
    {
        parent::__construct('form', $attributes, $content);
    }

    /**
     * @param string $action
     * @return $this
     */
    public function action(string $action): Form
    {
        $this->attributes(['action' => $action]);
        return $this;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function method(string $method): Form
    {
        $this->attributes(['method'=>$method]);
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @param string $type
     * @param array|null $attributes
     * @return $this
     */
    public function input(string $name, string $value, string $type = 'text', array $attributes = null): Form
    {
        $this->content(self::setInput($name,$value,$type,$attributes));
        return $this;
    }

    /**
     * @param $content
     * @param string|null $label
     * @param array|null $attributes
     * @return $this
     */
    public function fieldset($content, string $label = null, array $attributes = null): Form
    {
        $this->content(self::setFieldset($content, $label, $attributes));
        return $this;
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $legend
     * @param string $type
     * @param array|null $attributes
     * @param array|null $attributesInput
     * @return $this
     */
    public function fieldsetWithInput(string $name, string $value = null, string $legend = null, string $type = 'text', array $attributes = null, array $attributesInput = null ): Form
    {
        $this->content(self::setFieldset(self::setInput($name,$value,$type,$attributesInput),$legend,$attributes));
        return $this;
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $legend
     * @param array|null $attributesFieldset
     * @param array $attributesTextarea
     * @return $this
     */
    public function fieldsetWithTextarea(string $name, string $value = null, string $legend = null, array $attributesFieldset = null, array $attributesTextarea = []): Form
    {
        $attributesTextarea['name'] =$name;
        $textArea = ['tag'=>'textarea','attributes'=>$attributesTextarea,'content'=>$value];
        $this->content(self::setFieldset($textArea,$legend,$attributesFieldset));
        return $this;
    }

    /**
     * @param array|null $attributes
     * @return $this
     */
    public function submitButtonSend(array $attributes = null): Form
    {
        $attributes['type'] = 'submit';
        $attributes['name'] = 'submit';
        $this->content(['tag'=>'button','attributes'=>$attributes,'content'=>'<span class="iconify form-submit-button form-submit-button-send" data-icon="mdi:send"></span>']);
        return $this;
    }

    /**
     * @param string|null $formaction
     * @param array $attributes
     * @return $this
     */
    public function submitButtonDelete(string $formaction = null, array $attributes = []): Form
    {
        $attributes['type'] = 'submit';
        $attributes['name'] = 'submit';
        $attributes['onclick'] = "return confirm('"._("Are you sure you want to delete this item?")."');";
        if ($formaction) $attributes['formaction'] = $formaction;
        $this->content(['tag'=>'button','attributes'=>$attributes,'content'=>'<span class="material-icons form-submit-button form-submit-button-delete">delete</span>']);
        return $this;
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string $type
     * @param array|null $attributes
     * @return array
     */
    private static function setInput(string $name, string $value = null, string $type = 'text', array $attributes = null): array
    {
        $attr1 = ['name'=>$name,'value'=>$value,'type'=>$type];
        $attr2 = $attributes ? array_merge($attr1,$attributes) : $attr1;
        return ['tag'=>'input','attributes'=>$attr2];
    }

    /**
     * @param $content
     * @param string|null $legend
     * @param array|null $attributes
     * @return array
     */
    private static function setFieldset($content, string $legend = null, array $attributes = null): array
    {
        $newContent[] = $legend ? ['tag'=>'legend','content'=>$legend] : null;
        $newContent[] = $content;
        return ['tag'=>'fieldset','attributes'=>$attributes,'content'=>$newContent];
    }

}
