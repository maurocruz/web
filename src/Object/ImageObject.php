<?php

declare(strict_types=1);

namespace Plinct\Web\Object;

use Exception;
use Plinct\Tool\Image\Image;

class ImageObject
{
  /**
   *
   */
  const SRCSET_SMALL = '640';
  /**
   *
   */
  const SRCSET_MEDIUM = '750';
  /**
   *
   */
  const SRCSET_LARGE = '1080';
  /**
   * @var array
   */
  private array $srcsetAttributes;

  /**
   * @throws Exception
   */
  public function __invoke($value): ?array
  {
		$src = $value['src'] ?? null;

		// BROKEN IMAGE SVG
    $returns = ['tag'=>'div','attributes'=>['data-src'=>$src],'content'=>'<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="100%" height="100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M19 5v11.17l2 2V5c0-1.1-.9-2-2-2H5.83l2 2H19zM2.81 2.81L1.39 4.22L3 5.83V19c0 1.1.9 2 2 2h13.17l1.61 1.61l1.41-1.41L2.81 2.81zM5 19V7.83l7.07 7.07l-.82 1.1L9 13l-3 4h8.17l2 2H5z" fill="#e3e3e3"/></svg>'];

    if ($src && $src !== '') {
      $pathinfo = pathinfo($src);
      $width = isset($value['width']) && $value['width'] != '0' ? $value['width'] : null;
      $height = isset($value['height']) && $value['height'] != '0' ? $value['height'] : null;

      // SVG TYPE
      if (isset($pathinfo['extension']) && $pathinfo['extension'] == "svg") {
          $returns = [ "tag" => "img", "attributes" => [ 'src' => $src ]];

      } else {
	      // CALL IMAGE CLASS
	      $image = new Image($src);

	      if (!$image->isValidImage()) return $returns;

        // SET VARS
        $caption = isset($value['caption']) ? strip_tags($value['caption']) : null;
        $originalSrc = ["data-source" => $src, "data-caption" => $caption ?? null];

        $attributes = isset($value['attributes']) ? array_merge($originalSrc, $value['attributes']) : $originalSrc;

				if(isset($value['alt'])) {
					$attributes['alt'] = $value['alt'];
				}

        $this->srcsetAttributes['sizes'] = "";
        $this->srcsetAttributes['srcset'] = "";
        $this->srcsetAttributes['src'] = "";


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
        $returns = ["tag" => "img", "attributes" => array_merge($attributes, $this->srcsetAttributes)];
      }

      // IF HREF
      if (isset($value['href']) && $value['href'] !== '') {
          $hrefAttr = isset($value['hrefAttributes']) ? array_merge(["href" => $value['href']], $value['hrefAttributes']) : ["href" => $value['href']];
          $returns = ["tag" => "a", "attributes" => $hrefAttr, "content" => $returns];
      }
    }

    // RESPONSE
    return $returns;
  }

  /**
   * @param $image
   * @param $newwidth
   */
  private function srcsetAttributes($image, $newwidth)
  {
    $height = (string) ($newwidth / $image->getNewRatio());
    $thumb =  $image->thumbnail($newwidth, $height);
    $this->srcsetAttributes['srcset'] .= sprintf("%s %sw, ", $thumb, $newwidth);
    $this->srcsetAttributes['sizes'] .= sprintf("(max-width: %spx) %spx, ", $newwidth, $newwidth);
  }
}
