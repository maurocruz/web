<?php

namespace Plinct\Web\Widget;

trait HtmlElementTrait 
{    
    protected static function simpleTag(string $tag, $content = null, array $attributes = null) 
    {
        return [ "tag" => $tag, "attributes" => $attributes, "content" => $content ];
    } 
    
    protected static function noContent() 
    {
        return self::simpleTag("p", _("No content"), [ "class" => "warning"]);
    }
}
