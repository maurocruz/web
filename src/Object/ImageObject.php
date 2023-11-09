<?php
declare(strict_types=1);
namespace Plinct\Web\Object;

use Exception;
use Plinct\Tool\Image\Image;

class ImageObject
{
	/**
	 * @var string|mixed|null
	 */
	private ?string $source;
	/**
	 * @var Image
	 */
	private Image $image;
	/**
	 * @var string|mixed
	 */
	private string $alt;
	/**
	 * @var string|int|float|mixed|null
	 */
	private $width;
	/**
	 * @var string|mixed|null
	 */
	private ?string $href;
	/**
	 * @var array|mixed|null
	 */
	private ?array $hrefAttributes;
	/**
	 * @var string
	 */
	private string $icoSize = '200';
	/**
	 * @var string
	 */
	private string $smallSize = '520';
	/**
	 * @var string
	 */
	private string $mediumSize = '800';
	/**
	 * @var string
	 */
	private string $largeSize = '1280';
	/**
	 * @var array|null
	 */
	private ?array $sizes = null;
	/**
	 * @var array|null
	 */
	private ?array $srcset = null;
	/**
	 * @var array|mixed
	 */
	private array $attributes;
	/**
	 * @var bool
	 */
	private bool $broked = false;
  /**
   * @throws Exception
   */
  public function __construct($value)
  {
		$this->source = $value['src'] ?? '';
		$this->alt = $value['alt'] ?? '';
		$this->href = $value['href'] ?? null;
	  $this->attributes = $value['attributes'] ?? [];
		$this->hrefAttributes = $value['hrefAttributes'] ?? null;
	  $this->image = new Image($this->source);
		$this->width = isset($value['width']) && $value['width'] != '0'	? $value['width'] : (isset($value['height']) && $value['height'] != '0' ? 1 : null);
	  $this->width = ($this->width <= 1 ? $this->largeSize * $this->width : $this->width);
	  if (!$this->image->isValidImage()) {
			$this->broked = true;
		} elseif ($this->image->getExtension() !== 'svg' && $this->width && !$this->image->isRemote()) {
      // ICO
      $height = isset($value['height']) && $value['height'] != '0' ? $value['height'] : null;
      $originalWidth = $this->image->getWidth();
      $icoImage = $this->image->thumbnail($this->icoSize, $height);
      if ($this->width > $this->icoSize && $originalWidth > $this->smallSize) {
        $this->srcsetAttributes($this->smallSize);
      }
      if ($this->width > $this->smallSize && $originalWidth > $this->mediumSize) {
        $this->srcsetAttributes($this->mediumSize);
      }
      if ($this->width > $this->mediumSize && $originalWidth > $this->largeSize) {
        $this->srcsetAttributes($this->largeSize);
      }
      // SET ATTRIBUTES
      $this->sizes[] = $originalWidth < $this->width ? $originalWidth.'px' : $this->width . 'px';
			$this->srcset[] = sprintf("%s %sw", $icoImage, $originalWidth < $this->icoSize ? $originalWidth : $this->icoSize);
    }
  }
	/**
	 * @param $newwidth
	 * @throws Exception
	 */
  private function srcsetAttributes($newwidth)
  {
    $height = (string) ($newwidth / $this->image->getNewRatio());
    $thumb =  $this->image->thumbnail($newwidth, $height);
	  $slot = $this->width < $newwidth ? $this->width : $newwidth;
	  $this->sizes[] = sprintf("(max-width: %spx) %spx", $newwidth, $slot);
		$this->srcset[] = sprintf("%s %sw", $thumb, $newwidth);
  }
	/**
	 * @return array
	 */
	private function getBrokenImage(): array
	{
		return ['tag'=>'div','attributes'=>['data-src'=>$this->source],'content'=>'<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="100%" height="100%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M19 5v11.17l2 2V5c0-1.1-.9-2-2-2H5.83l2 2H19zM2.81 2.81L1.39 4.22L3 5.83V19c0 1.1.9 2 2 2h13.17l1.61 1.61l1.41-1.41L2.81 2.81zM5 19V7.83l7.07 7.07l-.82 1.1L9 13l-3 4h8.17l2 2H5z" fill="#e3e3e3"/></svg>'];
	}
	/**
	 * @return array
	 */
	public final function ready(): array
	{
		if ($this->broked) {
			return $this->getBrokenImage();
		} else {
			$baseAttributes['data-source'] = $this->source;
			$baseAttributes['alt'] = $this->alt;
			if ($this->sizes) $baseAttributes['sizes'] = implode(', ', $this->sizes);
			if ($this->srcset) $baseAttributes['srcset'] = implode(', ', $this->srcset);
			$baseAttributes['src'] = $this->source;
			$img = ['tag' => 'img','attributes' => $this->attributes ? array_merge($baseAttributes, $this->attributes) : $baseAttributes];
			if($this->href) {
				$hrefAttr = $this->hrefAttributes ? array_merge(["href" => $this->href], $this->hrefAttributes) : ["href" => $this->href];
				return ["tag" => "a", "attributes" => $hrefAttr, "content" => $img];
			} else {
				return $img;
			}
		}
	}
}
