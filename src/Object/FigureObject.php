<?php
declare(strict_types=1);
namespace Plinct\Web\Object;

use Exception;

class FigureObject {
  /**
   * @throws Exception
   */
  public function __invoke($value): array
  {
    $attributes = $value['attributes'] ?? null;
    $href = isset($value['href']) && $value['href'] != '' ? $value['href'] : null ;
    // title
    if (array_key_exists('title', $value) && $value['title'] !== "") {
      $content[] = [ "tag" => "h1", "content" => $value['title'], "href" => $href ];
    }
    // img
    if (array_key_exists('src', $value)) {
      $value['attributes'] = $value['imgAttributes'] ?? null;
      $content[] = (new ImageObject($value))->ready();
    }
    // caption
    if (array_key_exists('caption', $value) && $value['caption']) {
      $content[] = [ "tag" => "figcaption", "attributes" => $value['figcaptionAttributes'] ?? null, "content" => $value['caption'], "href" => $href ];
    }
    // content
    if (array_key_exists('content', $value) && $value['content']) {
      $content[] = $value['content'];
    }
    return [ "tag" => "figure", "attributes" => $attributes, "content" => $content ?? null ];
  }
}
