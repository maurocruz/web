<?php

namespace Plinct\Web\Object;

class FigureObject {
    
    public function __invoke($value) {        
        $attributes = $value['attributes'] ?? null;        
        // title
        if (array_key_exists('title', $value) && $value['title'] !== "") {
            $content[] = [ "tag" => "h1", "content" => $value['title'], "href" => $value['href'] ?? null ];
        }
        // img
        if (array_key_exists('src', $value)) {
            $value['attributes'] = $value['imgAttributes'] ?? null;
            $content[] = (new ImageObject())($value);
        }
        // caption
        if (array_key_exists('caption', $value) && $value['caption'] == true) {
            $content[] = [ "tag" => "figcaption", "content" => $value['caption'], "href" => $value['href'] ?? null ];
        }
        // content
        if (array_key_exists('content', $value) && $value['content'] == true) {
            $content[] = $value['content'];
        }        
        return [ "tag" => "figure", "attributes" => $attributes, "content" => $content ?? null ];
    }
}
