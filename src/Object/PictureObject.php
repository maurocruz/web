<?php
namespace Plinct\Web\Object;

use Plinct\Tool\Image;
use Plinct\Tool\Thumbnail;

class PictureObject {
    private $src;
    
    public function __invoke($value): array
    {
        $image = Image::$IMAGE->getSrc() == $value['src'] ? Image::$IMAGE :  (new Image($value['src']));
        $sources = null;
        unset($value['object']);
        $this->src = $image->getSrc();
        $inFigure = null;

        // sources
        if((isset($value['sourceMeasures']) || isset($value['sources'])) && !$image->is_remote() && $image->is_valide()) {
            $sources[] = $this->sources($value, $image);
        }        
        // img
        $img = [ "tag" => "img", "attributes" => [ "src" => $this->src, "alt" => "image" ] ];
        foreach ($value as $key => $valuePicture) {
            if($key !== 'src' && $key !== "sources" && $key !== "sourceMeasures" && $key !== "attributes") {
                $inFigure = true;
            }            
        }
        $picture = [ "tag" => "picture", "content" => [ $sources, $img ] ];
        if ($inFigure) {
            // content
            $content = $value['content'] ?? null;
            $picHref = isset($value['href']) ? [ "tag" => "a", "attributes" => [ "href" => $value['href'] ], "content" => $picture ] : $picture;
            return [ "tag" => "figure", "attributes" => $value['attributes'] ?? null, "content" => [ $picHref, $content ] ];
        } else {
            $picture['attributes'] = $value['attributes'] ?? null;
            return $picture;
        }
    }
    
    //
    private function sources($value, Image $image): array {
        $sources = $value['sourceMeasures'] ?? $value['sources'];
        $srcset = null;
        $source = [];

        foreach ($sources as $key => $valueSource) {
            // set srcset
            if (isset($valueSource['height']) && is_null($valueSource['height'])) {
                $srcset = (new Thumbnail($image->getSource()))->getThumbnail($valueSource['width']);
            } elseif (isset($valueSource['height'])) {
                $srcset = (new Thumbnail($image->getSource()))->getThumbnail($valueSource['width'], $valueSource['height']);
            } elseif (isset($valueSource['srcset'])) {
                $srcset = $valueSource['srcset'];
            } else {
                break;
            }
            if (count($sources) == $key + 1) {
                $media = "(min-width: " . $sources[$key - 1]['width'] . "px)";
            } else {
                $media = "(max-width: " . $valueSource['width'] . "px)";
            }
            $srcWidth[] = $valueSource['width'];
            $srcHeight[] = $valueSource['height'];
            $source[] = ["tag" => "source", "attributes" => ["media" => $media, "srcset" => $srcset]];
        }
        $this->src = $srcset;
        return $source;
    }
}
