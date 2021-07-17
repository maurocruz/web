<?php
namespace Plinct\Web\Widget;

use Plinct\Tool\StructuredData;

trait HtmlElementTrait {

    protected static function simpleTag(string $tag, $content = null, array $attributes = null): array {
        return [ "tag" => $tag, "attributes" => $attributes, "content" => $content ];
    } 
    
    protected static function warning(): array {
        return self::simpleTag("p", _("No content"), [ "class" => "warning"]);
    }

    public static function noContent(string $message = "No content", array $attributes = null ): array {
        return ['tag'=>'p','attributes'=>$attributes,'content'=>_($message)];
    }

    protected static function arrowBack(): string {
        return "<span class='material-icons' style='cursor: pointer' onclick='history.back();'>arrow_back</span>";
    }

    protected static function scriptForJsonLd(array $value): array {
        return [ "tag" => "script", "attributes" => [ "type" => "application/ld+json"], "content" => (new StructuredData())->getJson($value) ];
    }
}
