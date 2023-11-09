<?php
declare(strict_types=1);
namespace Plinct\Web\Widget;

class PlinctMap
{
	/**
	 * @var array
	 */
	private array $attributes;
	/**
	 * @var float
	 */
	private float $lat;
	/**
	 * @var float
	 */
	private float $lng;
	/**
	 * @var float|int
	 */
	private float $zoom = 12;
	/**
	 * @var float|int
	 */
	private float $pitch = 0;
	/**
	 * @var float|int
	 */
	private float $bearing = 0;
	/**
	 * @var string
	 */
	private string $marker;
	/**
	 * @var string|null
	 */
	private ?string $api;

	/**
	 * @param array $attributes
	 * @param string|null $api
	 */
	public function __construct(array $attributes = [], string $api = null)
	{
		$this->attributes = $attributes;
		$this->api = $api;
	}
	/**
	 * @param array $attributes
	 * @return PlinctMap
	 */
	public function attributes(array $attributes): PlinctMap
	{
		$this->attributes = $attributes;
		return $this;
	}
	/**
	 * @param float $longitude
	 * @param float $latitude
	 * @return $this
	 */
	public function lngLat(float $longitude, float $latitude): PlinctMap
	{
		$this->lng = $longitude;
		$this->lat = $latitude;
		return $this;
	}
	/**
	 * @param string $marker
	 * @return PlinctMap
	 */
	public function marker(string $marker): PlinctMap
	{
		$this->marker = $marker;
		return $this;
	}
	/**
	 * @param float $zoom
	 * @return PlinctMap
	 */
	public function zoom(float $zoom): PlinctMap
	{
		$this->zoom = $zoom;
		return $this;
	}
	/**
	 * @return array
	 */
	public function ready(): array
	{
		$query['lat'] = $this->lat;
		$query['lng'] = $this->lng;
		$query['z'] = $this->zoom;
		$query['p'] = $this->pitch;
		$query['b'] = $this->bearing;
		$query['marker'] = $this->marker;
		$query['api'] = $this->api;
		$httpBuildQuery = http_build_query($query);
		return ['tag'=>'div','attributes'=>$this->attributes, 'content'=>[
			['tag'=>'iframe','attributes'=>['class'=>'plinctMapWidget-iframe', 'src'=>"https://map.plinct.com.br/embed?$httpBuildQuery"]],
			"<div class='plinctMapWidget-openIn'>"
				."<a href='https://www.google.com/maps/search/?api=1&query=$this->lat%2C$this->lng&zoom=$this->zoom' target='_blank'>Google Maps</a>"
				."<a href='https://ul.waze.com/ul?ll=$this->lat%2C$this->lng&navigate=yes&z=$this->zoom' target='_blank'>Waze</a>"
			."<a href='https://map.plinct.com.br?$httpBuildQuery' target='_blank'>Plinct Maps</a>"
			."</div>"
		]];
	}
}
