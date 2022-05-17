<?php

declare(strict_types=1);

namespace Plinct\Web\Object;

use Exception;
use Plinct\Tool\Image\Image;
use Plinct\Web\Element\Element;

class PictureObject
{
  /**
   * @throws Exception
   */
  public function __invoke($value): array
  {
    unset($value['object']);
    $src = $value['src'] ?? null;
    $attributes = $value['attributes'] ?? null;
    $sources = $value['sources'] ?? $value['sourceMeasures'] ?? null;

    // PICTURE
    $picture = new Element('picture',$attributes);

    // SOURCES
    $image = new Image($src);
    if ($sources) {
	    foreach ($sources as $valueSource) {
        $newWidth = $valueSource['width'];
        $newHeight = $valueSource['height'] ?? null;
        $source = new Element('source');
        $image->thumbnail($newWidth, $newHeight);
        $source->attributes(['media'=>"(max-width: {$newWidth}px)",'srcset'=>$image->getThumbSrc()]);
        $picture->content($source->ready());
      }
      $src = $image->getThumbSrc();
    } else {
	    $src = $image->getSrc();
    }

    // IMAGE
    $img = new Element('img');

    //SRC
    $img->attributes(['src'=>$src]);

    // HREF
    if (isset($value['href'])) {
      $a = new Element('a');
      $a->attributes(['href'=>$value['href']]);
      $a->content($img->ready());

      $picture->content($a->ready());

    } else {
      $picture->content($img->ready());
    }

    // CONTENT
    if (isset($value['content'])) $picture->content($value['content']);

    // RESPONSE
    return $picture->ready();
  }
}
