<?php
namespace Plinct\Web\Widget;

/**
 * !!!ON DEVELOPMENT!!!
 * Class OpenStreetMap
 * @package Plinct\Web\Widget
 */
class OpenStreetMap {
    private $latitude;
    private $longitude;
    private $attributes = [];

    public function __construct(float $latitude, float $longitude) {
        $this->latitude =  number_format($latitude,12);
        $this->longitude = number_format($longitude,12);
    }

    public function attributes(array $attributes): OpenStreetMap {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
        return $this;
    }

    public final function embedInIframe(): array {
        $indice = 0.0017032;
        $minLon = number_format((double) $this->longitude - $indice, 10);
        $minLat = number_format((double) $this->latitude - $indice, 10);
        $maxLon = number_format((double) $this->longitude + $indice, 10);
        $maxLat = number_format((double) $this->latitude + $indice, 10);
        $src = "https://www.openstreetmap.org/export/embed.html?bbox=$minLon%2C$minLat%2C$maxLon%2C$maxLat&amp;layer=mapnik&amp;marker=$this->latitude%2C$this->longitude";
        $this->attributes['src'] = $src;
        // RESPONSE
        return  [ "tag" => "iframe", "attributes" => $this->attributes ];
    }
}