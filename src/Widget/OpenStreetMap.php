<?php

declare(strict_types=1);

namespace Plinct\Web\Widget;

/**
 * !!!ON DEVELOPMENT!!!
 * Class OpenStreetMap
 * @package Plinct\Web\Widget
 */
class OpenStreetMap
{
	/**
	 * @var float
	 */
  private float $latitude;
	/**
	 * @var float
	 */
  private float $longitude;
	/**
	 * @var array
	 */
  private array $attributes = [];

	/**
	 * @param float $latitude
	 * @param float $longitude
	 */
  public function __construct(float $latitude, float $longitude)
  {
    $this->latitude = (float) number_format($latitude,12);
    $this->longitude =(float) number_format($longitude,12);
  }

	/**
	 * @param array $attributes
	 * @return $this
	 */
  public function attributes(array $attributes): OpenStreetMap
  {
    foreach ($attributes as $key => $value) {
      $this->attributes[$key] = $value;
    }
    return $this;
  }

	/**
	 * @return array
	 */
  public final function embedInIframe(): array
  {
    $indice = 0.0017032;
    $minLon = number_format($this->longitude - $indice, 10);
    $minLat = number_format($this->latitude - $indice, 10);
    $maxLon = number_format($this->longitude + $indice, 10);
    $maxLat = number_format($this->latitude + $indice, 10);
    $src = "https://www.openstreetmap.org/export/embed.html?bbox=$minLon%2C$minLat%2C$maxLon%2C$maxLat&amp;layer=mapnik&amp;marker=$this->latitude%2C$this->longitude";
    $this->attributes['src'] = $src;
    // RESPONSE
    return  [ "tag" => "iframe", "attributes" => $this->attributes ];
  }
}
