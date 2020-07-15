<?php

namespace Plinct\Web\Object;

class PictureObject 
{
    private $content = [];
    
    public function __invoke($value) 
    {
        // sources
        if(isset($value['sourceMeasures']) || isset($value['sources'])) {
            $this->sources($value);
        }        
        // img
        $this->content[] = [ "tag" => "img", "attributes" => [ "src" => $value['src'], "alt" => "image" ] ]; 
        
        // content
        $this->content[] = $value['content'] ?? null;  
        
        return [ "tag" => "picture", "attributes" => $value['attributes'] ?? null, "content" => $this->content ];
    }
    
    //
    private function sources($value)
    {
        $sources = $value['sourceMeasures'] ?? $value['sources'];
        
        foreach ($sources as $key => $valueSource) {
            // set srcset
            if (isset($valueSource['height']) && is_null($valueSource['height'])) {
                $srcset = (new ThumbnailObject($value['src']))->getThumbnail($valueSource['width']);
                
            } elseif (isset($valueSource['height'])) {
                $srcset = (new ThumbnailObject($value['src']))->getThumbnail($valueSource['width'], $valueSource['height']);
                
            } elseif (isset($valueSource['srcset'])) {
                $srcset = $valueSource['srcset'];
                
            } else {
                break;
            }
            
            if (count($sources) == $key+1) {
                $media = "(min-width: " . $sources[$key-1]['width'] . "px)";
                
            } else {                
                $media = "(max-width: " . $valueSource['width'] . "px)";
            }
            
            $this->content[] = [ "tag" => "source", "attributes" => [ "media" => $media, "srcset" => $srcset ] ];            
        }
    }
}