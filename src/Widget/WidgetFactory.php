<?php

declare(strict_types=1);

namespace Plinct\Web\Widget;

class WidgetFactory
{
    /**
     * @param float $latitude
     * @param float $longitude
     * @return OpenStreetMap
     */
    public static function openStreetMap(float $latitude, float $longitude): OpenStreetMap
    {
        return new OpenStreetMap($latitude, $longitude);
    }
}