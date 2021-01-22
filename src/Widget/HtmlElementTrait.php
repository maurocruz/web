<?php

namespace Plinct\Web\Widget;

trait HtmlElementTrait 
{    
    protected static function simpleTag(string $tag, $content = null, array $attributes = null): array
    {
        return [ "tag" => $tag, "attributes" => $attributes, "content" => $content ];
    } 
    
    protected static function noContent(): array
    {
        return self::simpleTag("p", _("No content"), [ "class" => "warning"]);
    }

    protected static function arrowBack(): array
    {
        return [ "object" => "image", "src" => "/App/static/cms/images/arrowBack.svg", "attributes" => [ "style" => "height: 48px; margin: 15px;"], "href" => "javascript: history.back();" ];
    }
}
