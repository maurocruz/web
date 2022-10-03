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

	/**
	 * @param array|null $attributes
	 * @return PlinctMap
	 */
		public static function map(array $attributes = null): PlinctMap
		{
			return new PlinctMap($attributes);
		}
}
