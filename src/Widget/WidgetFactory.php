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
	 * @param string|null $api
	 * @return PlinctMap
	 */
	public static function map(array $attributes = null, string $api = null): PlinctMap
	{
		return new PlinctMap($attributes, $api);
	}
}
