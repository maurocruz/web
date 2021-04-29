<?php
namespace Plinct\Web\Object;

use Plinct\Tool\Image\Image;

class ImageObject {
    const SRCSET_SMALL = '640';
    const SRCSET_MEDIUM = '750';
    const SRCSET_LARGE = '1080';
    private $srcsetAttributes;

    public function __invoke($value): array {
        // SET VARS
        $width = $value['width'] ?? null;
        $height = $value['height'] ?? null;
        $caption = isset($value['caption']) ? strip_tags($value['caption']) : null;
        $alt = $value['alt'] ?? $caption ?? "Image: ".basename($value['src']);
        $originalSrc = [ "data-source" => $value['src'], "data-caption" => $caption ?? null, "alt" => $alt ];
        $attributes = isset($value['attributes']) ? array_merge($originalSrc, $value['attributes']) : $originalSrc;
        $this->srcsetAttributes['sizes'] = "";
        $this->srcsetAttributes['srcset'] = "";
        $this->srcsetAttributes['src'] = "";
        // CALL IMAGE CLASS
        $image = new Image($value['src']);
        // THUMBNAIL
        if($width && $width !== '0') {
            // CREATE THUMBNAIL
            $src = $image->thumbnail($width, $height);
            // CREATE OTHER SRCSET IMAGES
            if ($width > self::SRCSET_SMALL) {
                $this->srcsetAttributes($image, self::SRCSET_SMALL);
            }
            if ($width > self::SRCSET_MEDIUM) {
                $this->srcsetAttributes($image, self::SRCSET_MEDIUM);
            }
            if ($width > self::SRCSET_LARGE) {
                $this->srcsetAttributes($image, self::SRCSET_LARGE);
            }
            // SET ATTRIBUTES
            $this->srcsetAttributes['sizes'] .= " {$width}px";
            $this->srcsetAttributes['srcset'] .= sprintf("%s %sw", $src, $width);
            $this->srcsetAttributes['src'] .= $src;
        } else {
            $this->srcsetAttributes = [ "src" => $image->getSrc() ];
        }
        // APPEND IN IMG ELEMENT
        $imgTag = [ "tag" => "img", "attributes" => array_merge($attributes, $this->srcsetAttributes) ];
        // IF HREF
        if (isset($value['href']) && $value['href'] !== '') {
            $hrefAttr = isset($value['hrefAttributes']) ? array_merge([ "href" => $value['href'] ], $value['hrefAttributes']) : [ "href" => $value['href'] ];
            $imgTag = [ "tag" => "a", "attributes" => $hrefAttr, "content" => $imgTag ];
        }
        // RESPONSE
        return $imgTag;
    }

    private function srcsetAttributes($image, $newwidth) {
        $height = (string) ($newwidth / $image->getNewRatio());
        $thumb =  $image->thumbnail($newwidth, $height);
        $this->srcsetAttributes['srcset'] .= sprintf("%s %sw, ", $thumb, $newwidth);
        $this->srcsetAttributes['sizes'] .= sprintf("(max-width: %spx) %spx, ", $newwidth, $newwidth);
    }
}
