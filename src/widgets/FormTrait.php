<?php

namespace Plinct\Web\Widget;

use Plinct\Api\Type\PropertyValue;

trait FormTrait 
{    
    use HtmlElementTrait;
       
    static protected function div($title, $type, $content) {        
        $contenido[] = [ "tag" => "h4", "content" => _($title) ];
        foreach ($content as $value) {
            $contenido[] = $value;
        }
        return [ "tag" => "div", "attributes" => [ "id" => "$type-form" ], "content" => $contenido ];
    }
    
    static protected function divBox($title, $type, $content) {        
        $contenido[] = [ "tag" => "h4", "content" => $title ];
        foreach ($content as $value) {
            $contenido[] = $value;
        }
        return [ "tag" => "div", "attributes" => [ "id" => "$type-form", "class" => "box" ], "content" => $contenido ];
    } 
    
    static protected function divBoxExpanding($title, $type, $content) {
        $id = "$type-form-". mt_rand(111,999);
        $contenido[] = [ "tag" => "h4", "content" => $title, "attributes" => [ "class" => "button-dropdown button-dropdown-contracted" ] ];
        foreach ($content as $value) {            
            $contenido[] = $value;
        }
        return [ "tag" => "div", "attributes" => [ "id" => $id, "class" => "box box-expanding" ], "content" => $contenido ];
    }
    
    static protected function form(string $action, array $content, $attributes = null ) 
    {
        $class = is_string($attributes) ? $attributes : "formPadrao";
        $attr = [ "class" => $class, "action" => $action, "method" => "post" ];
        $attrfinal = is_array($attributes) ? array_merge($attr, $attributes) : $attr;
        return [ "tag" => "form", "attributes" => $attrfinal, "content" => $content ];
    }
    
    static protected function input($name, $type, $value, $attributes = null) {
        $attr = [ "name" => $name, "type" => $type, "value" => $value ];
        $attr2 = $attributes ? array_merge($attr, $attributes) : $attr;
        return [ "tag" => "input", "attributes" => $attr2 ];
    }
    
    static protected function noContent() {
        return [ "tag" => "p", "content" => _("No content") ];
    }
    
    static protected function select(string $name, $valueChecked, array $value_label, $attributes_select = null) {
        // attributes
        $selectAttr = [ "name" => $name ];
        $attributes = $attributes_select ? array_merge($selectAttr, $attributes_select) : $selectAttr;
        // options      
        $options[] = $valueChecked ? [ "tag" => "option", "attributes" => [ "value" => $valueChecked ], "content" => _($valueChecked) ] : null;
        $options[] = [ "tag" => "option", "attributes" => [ "value" => "" ], "content" => _("Choose...") ];        
        foreach ($value_label as $key => $value) {
            $options[] = [ "tag" => "option", "attributes" => [ "value" => $key ], "content" => _($value) ];
        }
        return [ "tag" => "select", "attributes" => $attributes, "content" => $options ];
    }
    
    static protected function fieldsetWithInput($legend, $name, $value, $attributes = null, $type = "text", $inputAttributes = null) {
        $attr = [ "name" => $name, "type" => $type, "value" => $value ];
        $attributesInput = $inputAttributes ? array_merge($attr, $inputAttributes) : $attr;
        return [ "tag" => "fieldset", "attributes" => $attributes, "content" => [ 
            [ "tag" => "legend", "content" => $legend ],
            [ "tag" => "input", "attributes" => $attributesInput ]
        ]];
    }
    
    static protected function fieldsetWithSelect(string $legend, string $name, $valueChecked, array $valueLabelListOptions, array $attributes = null, array $attributes_select = null ) {
        return [ "tag" => "fieldset", "attributes" => $attributes, "content" => [ 
            [ "tag" => "legend", "content" => $legend ],
            self::select($name, $valueChecked, $valueLabelListOptions, $attributes_select)
        ]];        
    }
    
    static protected function fieldsetWithTextarea($legend, $name, $value, $height = 150, $attributes = null, $attributes_textarea = null) 
    {
        // attributes fieldset
        $h = $height."px";
        $attrFieldset = [ "style" => "width: 100%; min-height: $h;" ];
        
        $attributesFieldset = $attributes ? array_merge($attrFieldset, $attributes) : $attrFieldset;
        // attributes textarea
        $attrTextarea = [ "name" => $name, "id" => "textarea-$name", "style" => "min-height: calc($h - 50px);" ];
        $attr = $attributes_textarea ? array_merge($attrTextarea, $attributes_textarea) : $attrTextarea;
        
        return [ "tag" => "fieldset", "attributes" => $attributesFieldset, "content" => [ 
            [ "tag" => "legend", "content" => $legend ],
            [ "tag" => "textarea", "attributes" => $attr, "content" => $value ],
            [ "tag" => "a", "attributes" => [ "href" => "javascript:void();", "onclick" => "expandTextarea('textarea-$name',$height);", "style" => "width: 96%; display: block; font-size: 0.85em;" ], "content" => sprintf(_("Expandir textarea em %s"), $h) ]   
        ]];
    }
    
    protected function listAll($data, $type, string $title = null, array $row_column = null) 
    {          
        if (isset($data['errorInfo'])) {
            return self::errorInfo($data['errorInfo'], $type);
            
        } else {
            // form search
            $content[] = self::searchWithHttpRequest($type);                        

            $content[] = [ "tag" => "p", "content" => sprintf(_("Show %s items!"), $data['numberOfItems']) ];  
            
            // columns
            $columns = [ 
                [ "label" => "ID", "property" => "fwc_id", "attributes" => [ "style" => "width: 40px;"] ],
                [ "label" => _("Name"), "property" => "name" ]
            ];
            
            if ($row_column) {
                foreach ($row_column as $keyCR => $valueCR) {                
                    $columns[] = [ "label" => $valueCR, "property" => $keyCR ];
                    $valueAddRows[] = $keyCR;
                }
            }
            
            // rows
            if ($data['numberOfItems'] == 0) {
                $rows = [];
                
            } else {
                foreach ($data['itemListElement'] as $key => $valueItems) {
                    $item = $valueItems['item'];
                    $ID = PropertyValue::extractValue($item['identifier'],"fwc_id");                
                    $name = '<a href="/admin/'.$type.'/edit/'.$ID.'">'.($item['name'] ?? $item['headline'] ?? "[ND]").'</a>';
                    $rows[] = [ $ID, $name ];
                    if (isset($valueAddRows)) {
                        foreach ($valueAddRows as $valueR) {
                            $array = is_array($item[$valueR]) ? $item[$valueR]['name'] : $item[$valueR];
                            array_push($rows[$key],$array);
                        }
                    }
                }
            }      
            
            $caption = $title ? $title : _("List of $type");
            $content[] = self::tableItemList($columns, $rows, _($caption));
            
            return [ "tag" => "div", "content" => $content ];
        }
    }
    
    static protected function tableItemList(array $columns, array $rows, $caption = null) {         
        foreach ($columns as $valueColumns) {
            $th[] = [ "tag" => "th", "attributes" => $valueColumns['attributes'] ?? null, "content" => '<a href="?order='.$valueColumns['property'].'">'.$valueColumns['label'].'</a>' ];
        }
        
        $td = null;
        if (count($rows) == 0) { // NO ITENS FOUNDED
            $list[] = [ "tag" => "tr", "content" => [
                [ "tag" => "td", "attributes" => [ "colspan" => "5", "style" => "text-align: center; font-weight: bold; font-size: 120%;" ], "content" => _("No items founded!") ]
            ]];            
        } else { 
            foreach ($rows as $valueRows) {                
                foreach ($valueRows as $valueItens ) {
                    $td[] = [ "tag" => "td", "content" => $valueItens['rowText'] ?? $valueItens ];
                }
                $list[] = [ "tag" => "tr", "content" => $td ];
                unset($td);
            }
        }
        return [ "tag" => "table", "attributes" => [ "class" => "table" ], "content" => [
            [ "tag" => "caption", "content" => $caption ],
            [ "tag" => "thead", "content" => [
                [ "tag" => "tr", "content" => $th ]
            ]],
            [ "tag" => "tbody", "content" => $list ]
        ]];
    }
        
    static protected function errorInfo($data, $type) { 
        if ($data[0] == '42S02') {
            return [ "tag" => "div", "content" => [
                [ "tag" => "p", "content" => _($data[2]) ],
                [ "tag" => "form", "attributes" => [ "action" => "/admin/$type/createSqlTable", "method" => "post" ], "content" => [
                    [ "tag" => "input", "attributes" => [ "type" => "submit", "value" => _("Do you want to install it?") ] ]
                ]]
            ]];
        }
    }
    
    
    protected static function radio(string $legend, string $name, $value, array $labels) {
        $content[] = [ "tag" => "legend", "content" => $legend ];        
        foreach ($labels as $valueLabel) {
            $checked = $value == $valueLabel ? "checked" : null;           
            $content[] = [ "tag" => "label", "content" => [
                [ "tag" => "input", "attributes" => [ "name" => $name, "type" => "radio", "value" => $valueLabel, $checked ] ],
                [ "tag" => "span", "content" => " ".$valueLabel ]
            ]]; 
        }
        return [ "tag" => "fieldset", "content" => $content ];
    }
    
    protected static function submitButtonSend($attributes = null) {
        $attr = [ "name" => "submit", "src" => "/fwcSrc/images/ok_64x64.png", "style" => "max-width: 40px; vertical-align: bottom; margin: 6px;", "type" => "image", "alt" => "Enviar", "title" => _("Submit") ];
        $attr2 = $attributes ? array_merge($attr, $attributes) : $attr;        
        return [ "tag" => "input", "attributes" => $attr2 ];
    }
    
    protected static function submitButtonDelete($formaction, $attributes = null) {
        $attr = [ "name" => "submit", "src" => "/fwcSrc/images/delete.png", "formaction" => $formaction, "style" => "max-width: 40px; vertical-align: bottom; margin: 6px;", "type" => "image", "alt" => _("Delete data"), "title" => _("Delete data"), "onclick" => "return confirm('".("Are you sure you want to delete this item?")."');" ];        
        $attr2 = $attributes ? array_merge($attr, $attributes) : $attr;        
        return [ "tag" => "input", "attributes" => $attr2 ];
    }
    
    protected static function searchWithHttpRequest($type) {
        return [ "tag" => "form", "attributes" => [ "name" => "formSearch", "class" => "searchForm", "action" => "", "method" => "get" ], "content" => [
            [ "tag" => "fieldset", "content" => [
                [ "tag" => "input", "attributes" => [ "id" => "searchByName", "data-type" => $type, "name" => "q", "type" => "text", "value" => filter_input(INPUT_GET, 'search'), "autocomplete" => "off" ]],
                [ "tag" => "input", "attributes" => [ "type" => "image", "src" => "/fwcSrc/images/lupa_32x32.png", "onclick" => "submit()", "alt" => _("Search") ] ]
            ] ] 
        ]];
    }
    
    public static function search($action, $name,  $value = null, $method = "get") {
        return [ "tag" => "form", "attributes" => [ "name" => "formSearch", "class" => "form", "action" => $action, "method" => $method ], "content" => [
            [ "tag" => "fieldset", "content" => [
                [ "tag" => "legend", "content" => _("Search") ],
                [ "tag" => "input", "attributes" => [ "name" => $name, "type" => "text", "value" => $value ]],
                [ "tag" => "input", "attributes" => [ "type" => "submit", "value" => _("Submit") ] ]
            ] ] 
        ]];
    }
}
