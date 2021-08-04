<?php
namespace Plinct\Web\Object;

use Exception;
use Plinct\Tool\Curl;
use Plinct\Tool\Image\Image;

class ImageObject {
    const SRCSET_SMALL = '640';
    const SRCSET_MEDIUM = '750';
    const SRCSET_LARGE = '1080';
    private $srcsetAttributes;

    /**
     * @throws Exception
     */
    public function __invoke($value): array {
        $pathinfo = pathinfo($value['src']);
        $width = isset($value['width']) && $value['width'] != '0' ? $value['width'] : null;
        $height = isset($value['height']) && $value['height'] != '0' ? $value['height'] : null;
        $src = $value['src'];
        // SVG TYPE
        if ($pathinfo['extension'] == "svg") {
            $image = new Image($value['src']);
            if ($width) {
                $image->thumbnail($width, $height);
                $src = $image->getThumbSrc();
            }
            $svg = Curl::getUrlContents($src);
            $imgTag = $svg;
        }
        else {
            // SET VARS
            $caption = isset($value['caption']) ? strip_tags($value['caption']) : null;
            $alt = $value['alt'] ?? $caption ?? "Image: " . basename($value['src']);
            $originalSrc = ["data-source" => $value['src'], "data-caption" => $caption ?? null, "alt" => $alt];
            $attributes = isset($value['attributes']) ? array_merge($originalSrc, $value['attributes']) : $originalSrc;
            $this->srcsetAttributes['sizes'] = "";
            $this->srcsetAttributes['srcset'] = "";
            $this->srcsetAttributes['src'] = "";
            // CALL IMAGE CLASS
            $image = new Image($value['src']);
            // THUMBNAIL
            if ($width) {
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

                $this->srcsetAttributes['sizes'] .= " {$image->getNewWidth()}px";
                $this->srcsetAttributes['srcset'] .= sprintf("%s %sw", $src, $image->getNewWidth());
                $this->srcsetAttributes['src'] .= $image->getSrc();
            } else {
                $this->srcsetAttributes = ["src" => $image->getSrc()];
            }
            // APPEND IN IMG ELEMENT
            $imgTag = ["tag" => "img", "attributes" => array_merge($attributes, $this->srcsetAttributes)];
        }
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
