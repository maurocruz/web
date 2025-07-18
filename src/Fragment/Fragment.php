<?php
namespace Plinct\Web\Fragment;

use Plinct\Web\Element\Figure;
use Plinct\Web\Element\ListElement;
use Plinct\Web\Element\Picture;
use Plinct\Web\Element\Table;
use Plinct\Web\Element\Video;
use Plinct\Web\Fragment\Breadcrumb\Breadcrumb;
use Plinct\Web\Fragment\Breadcrumb\BreadcrumbInterface;
use Plinct\Web\Fragment\Icons\IconsFragment;
use Plinct\Web\Fragment\PageNavigation\PageNavigation;
use Plinct\Web\Widget\OpenStreetMap;
use Plinct\Web\Widget\Scrollup;

class Fragment
{
  /**
   * @return BreadcrumbInterface
   */
  public static function breadcrumb(): BreadcrumbInterface
  {
    return new Breadcrumb();
  }

  /**
   * @param array|null $attributes
   * @return Figure
   */
  public static function figure(array $attributes = null): Figure
  {
    return new Figure($attributes);
  }

	/**
	 * @return IconsFragment
	 */
  public static function icons(): IconsFragment
  {
    return new IconsFragment();
  }

	public function imageResponsive(string $url, string $alt = 'image', string $rel = null): string
	{
		return (new ImageResponsive())->imagemResponsive($url, $alt, $rel);
	}
	/**
	 * @param array|null $attributes
	 * @return ListElement
	 */
	public static function list(array $attributes = null): ListElement
	{
		return new ListElement($attributes);
	}

	/**
	 * @param float $latitude
	 * @param float $longitude
	 * @return OpenStreetMap
	 */
	public static function map(float $latitude, float $longitude): OpenStreetMap
	{
		return new OpenStreetMap($latitude, $longitude);
	}

	/**
	 * @param array|null $attributes
	 * @return PageNavigation
	 */
	public static function pageNavigation(array $attributes = null): PageNavigation
	{
		return new PageNavigation($attributes);
	}

	/**
	 * @param array|null $attributes
	 * @return Picture
	 */
	public static function picture(array $attributes = null): Picture
	{
		return new Picture($attributes);
	}

  /**
   * @param string $jsonSchema
   * @return string
   */
  public static function scriptJsonLd(string $jsonSchema): string
  {
    return "<script type='application/ld+json'>$jsonSchema</script>";
  }

  /**
   * @return Scrollup
   */
  public static function scrollup(): Scrollup
  {
    return new Scrollup();
  }

	/**
	 * @return Table
	 */
  public static function table() : Table
  {
    return new Table();
  }

	/**
	 * @param array|null $attributes
	 * @return Video
	 */
	public static function video(array $attributes = null): Video
	{
		return new Video($attributes);
	}
}
