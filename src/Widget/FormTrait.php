<?php
declare(strict_types=1);

namespace Plinct\Web\Widget;

use Plinct\Web\Element\Element;

trait FormTrait // DEPRECATED
{
    use HtmlElementTrait;

    public static function fieldset($content, $legend = null, $attributes = null): array {
        $contentFieldset[] = $legend ? [ "tag" => "legend", "content" => $legend ] : null;
        $contentFieldset[] = $content;
        return [ "tag" => "fieldset", "attributes" => $attributes, "content" => $contentFieldset ];
    }

    protected static function fieldsetWithInput($legend, $name, $value, $attributes = null, $type = "text", $inputAttributes = null): array {
        $attr = [ "name" => $name, "type" => $type, "value" => $value ];
        $attributesInput = $inputAttributes ? array_merge($attr, $inputAttributes) : $attr;
        return [ "tag" => "fieldset", "attributes" => $attributes, "content" => [
            [ "tag" => "legend", "content" => _($legend) ],
            [ "tag" => "input", "attributes" => $attributesInput ]
        ]];
    }

    protected static function fieldsetWithSelect(string $legend, string $name, $valueChecked, array $valueLabelListOptions, array $attributes = null, array $attributes_select = null ): array {
        return [ "tag" => "fieldset", "attributes" => $attributes, "content" => [
            [ "tag" => "legend", "content" => _($legend) ],
            self::select($name, $valueChecked, $valueLabelListOptions, $attributes_select)
        ]];
    }

    protected static function fieldsetWithTextarea($legend, $name, $value, $height = 150, $attributes = null, $attributes_textarea = null): array {
        // attributes fieldset
        $h = $height."px";
        $attrFieldset = [ "style" => "width: 100%; min-height: $h;" ];
        $attributesFieldset = $attributes ? array_merge($attrFieldset, $attributes) : $attrFieldset;
        // attributes textarea
        $attrTextarea = [ "name" => $name, "id" => "textarea-$name", "style" => "min-height: calc($h - 50px);" ];
        $attr = $attributes_textarea ? array_merge($attrTextarea, $attributes_textarea) : $attrTextarea;
        return [ "tag" => "fieldset", "attributes" => $attributesFieldset, "content" => [
            [ "tag" => "legend", "content" => _($legend) ],
            [ "tag" => "textarea", "attributes" => $attr, "content" => $value ],
            [ "tag" => "a", "attributes" => [ "href" => "javascript:void();", "onclick" => "expandTextarea('textarea-$name',$height);", "style" => "width: 96%; display: block; font-size: 0.85em;" ], "content" => sprintf(_("Expandir textarea em %s"), $h) ]
        ]];
    }

    protected static function form(string $action, array $content, $attributes = null ): array {
        $class = is_string($attributes) ? $attributes : "formPadrao";
        $attr = [ "class" => $class, "action" => $action, "method" => "post" ];
        $attrfinal = is_array($attributes) ? array_merge($attr, $attributes) : $attr;
        return [ "tag" => "form", "attributes" => $attrfinal, "content" => $content ];
    }

    protected static function input(string $name, string $type, string $value = null, array $attributes = null): array {
        $attr = [ "name" => $name, "type" => $type, "value" => $value ];
        $attr2 = $attributes ? array_merge($attr, $attributes) : $attr;
        return [ "tag" => "input", "attributes" => $attr2 ];
    }

    protected static function select(string $name, $valueChecked, array $value_label, $attributes_select = null): array {
        // attributes
        $selectAttr = [ "name" => $name ];
        $attributes = $attributes_select ? array_merge($selectAttr, $attributes_select) : $selectAttr;
        // options
        if (is_array($valueChecked)) {
            $options[] = [ "tag" => "option", "attributes" => [ "value" => key($valueChecked) ], "content" => _(current($valueChecked)) ];
        } else {
            $options[] = $valueChecked ? [ "tag" => "option", "attributes" => [ "value" => $valueChecked ], "content" => _($valueChecked) ] : null;
        }
        $options[] = [ "tag" => "option", "attributes" => [ "value" => "" ], "content" => _("Choose...") ];
        foreach ($value_label as $key => $value) {
            $options[] = [ "tag" => "option", "attributes" => [ "value" => $key ], "content" => _($value) ];
        }
        return [ "tag" => "select", "attributes" => $attributes, "content" => $options ];
    }

    protected static function radio(string $legend, string $name, $value, array $labels): array {
        $content[] = [ "tag" => "legend", "content" => _($legend) ];
        foreach ($labels as $valueLabel) {
            $checked = $value == $valueLabel ? "checked" : null;
            $content[] = [ "tag" => "label", "content" => [
                [ "tag" => "input", "attributes" => [ "name" => $name, "type" => "radio", "value" => $valueLabel, $checked ] ],
                [ "tag" => "span", "content" => " ".$valueLabel ]
            ]];
        }
        return [ "tag" => "fieldset", "content" => $content ];
    }

    protected static function checkbox(string $name, string $value, array $attributes = null): array {
        $attr1 = [ "name" => $name, "type" => "checkbox", "value" => $value ];
        $attr2 = $attributes ? array_merge($attr1, $attributes) : $attr1;
        return [ "tag" => "input", "attributes" => $attr2 ];
    }

    protected static function submitButtonSend($attributes = null): array {
        $attr = ['type'=>'submit','name'=>'submit','class'=>'form-submit-button form-submit-button-send','title'=>('Submit'),'alt'=>_('Submit')];
        $attr2 = $attributes ? array_merge($attr, $attributes) : $attr;
        $button = new Element('button',$attr2);
        $button->content('<span class="material-icons">send</span>');
        return $button->ready();
    }

    protected static function submitButtonDelete($formaction, $attributes = null): array {
        $attr = ['type'=>'submit','name'=>'submit','class'=>'form-submit-button form-submit-button-delete','formaction'=>$formaction,'alt'=>_('Delete data'),'title'=>_('Delete data'),'onclick'=>"return confirm('"._("Are you sure you want to delete this item?")."');" ];
        $attr2 = $attributes ? array_merge($attr, $attributes) : $attr;
        $button = new Element('button',$attr2);
        $button->content('<span class="material-icons">delete</span>');
        return $button->ready();
    }

    public static function search(string $action, string $name, string $value = null, string $method = "get", array $attributes = null): array {
        // attributes
        $attr1 = [ "name" => "formSearch", "class" => "form", "action" => $action, "method" => $method ];
        $attr2 = $attributes ? array_merge($attr1, $attributes) : $attr1;
        // legend
        $content[] = [ "tag" => "legend", "content" => _("Search") ];
        // queries
        $queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        if ($queryString) {
            parse_str($queryString, $queryArray);
            if ($queryArray) {
                foreach ($queryArray as $nameQuery => $valueQuery) {
                    $content[] = ["tag" => "input", "attributes" => ["name" => $nameQuery, "type" => "hidden", "value" => $valueQuery]];
                }
            }
        }
        // input search
        $content[] = [ "tag" => "input", "attributes" => [ "name" => $name, "type" => "text", "value" => $value ]];
        // submit
        $content[] = [ "tag" => "input", "attributes" => [ "type" => "submit", "value" => _("Submit") ] ];
        // response
        return [ "tag" => "form", "attributes" => $attr2, "content" => [
            [ "tag" => "fieldset", "content" => $content ]
        ]];
    }
}
