<?php
namespace Plinct\Web\Object;

use Exception;
use Plinct\Tool\Image\ImageProcessor;

class ImageObject
{
	/**
	 * @var string|mixed|null
	 */
	private ?string $source;
	/**
	 * @var string|mixed
	 */
	private string $alt;
	/**
	 * @var string|int|float|mixed|null
	 */
	private mixed $width;
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
	private string $tinySize = '320';
	/**
	 * @var string
	 */
	private string $smallSize = '520';
	/**
	 * @var string
	 */
	private string $mediumSize = '840';
	/**
	 * @var string
	 */
	private string $largeSize = '1360';
	/**
	 * @var array|null
	 */
	private ?array $sizes = null;
	/**
	 * @var array|null
	 */
	private ?array $srcset = null;
	/**
	 * @var string
	 */
	private string $src;
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
		$this->src = $value['src'] ?? '';
		$this->alt = $value['alt'] ?? '';
		$this->href = $value['href'] ?? null;
	  $this->attributes = $value['attributes'] ?? [];
		$this->hrefAttributes = $value['hrefAttributes'] ?? null;

	  $height = isset($value['height']) && $value['height'] != '0' ? $value['height'] : null;
		if (!str_contains($this->source,'http')) {
			$localSource = $_SERVER['DOCUMENT_ROOT'] . (str_starts_with($this->source,'/') ? $this->source : '/' . $this->source);
		} else {
			$localSource = $_SERVER['DOCUMENT_ROOT'] . parse_url($this->source)['path'];
		}

	  if (!file_exists($localSource)) {
		  $headers = @get_headers($this->source, 1);
		  if (!isset($headers[0]) && !str_contains($headers[0], '200')) {
			  $this->broked = true;
		  }
		} else {
			$image = new ImageProcessor(realpath($localSource));
			$this->width = isset($value['width']) && $value['width'] != '0' ? $value['width'] : (isset($value['height']) && $value['height'] != '0' ? 1 : null);
			$this->width = ($this->width <= 1 ? $image->getWidth()  * $this->width : $this->width);

			if (!$image->isValidImage()) {
				$this->broked = true;
			} elseif ($image->getExtension() !== 'svg' && $this->width && $image->getWidth() > $this->tinySize) {
				$pathinfo = pathinfo($localSource);
				$tinyFilename = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '_t';
				$smallFilename = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '_s';
				$mediumFilename = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '_m';
				$largFilename = $pathinfo['dirname'] . '/' . $pathinfo['filename'];
				// TINY WIDTH
				$tinyPathname = !file_exists($tinyFilename . ".webp") ? $image->createNewImage($tinyFilename, $this->tinySize, $height) : $tinyFilename . ".webp";
				$this->srcsetAttributes($tinyPathname, $this->tinySize, $this->width);
				if (file_exists($tinyPathname)) $this->src = $tinyPathname;
				// SMALL WIDTH
				if ($this->width > $this->smallSize) {
					$smallPathName = !file_exists($smallFilename. ".webp") ? $image->createNewImage($smallFilename, $this->smallSize, $height) : $smallFilename . ".webp";
					$this->srcsetAttributes($smallPathName, $this->smallSize, $this->width);
				}
				// MEDIUM WIDTH
				if ($this->width > $this->mediumSize) {
					$mediumPathName = !file_exists($mediumFilename. ".webp") ? $image->createNewImage($mediumFilename, $this->mediumSize, $height) : $mediumFilename . ".webp";
					$this->srcsetAttributes($mediumPathName, $this->mediumSize, $this->width);
				}
				// LARGE WIDTH
				$largePathName = $image->getWidth() > $this->largeSize ? $image->createNewImage($largFilename, $image->getWidth(), $height) : $localSource;
				$this->srcsetAttributes($largePathName, $image->getWidth(), $this->width);
			}
		}
  }

	/**
	 * @param $srcsetLocalImage
	 * @param $newWidth
	 * @param $maxWidth
	 * @return void
	 */
  private function srcsetAttributes($srcsetLocalImage, $newWidth, $maxWidth): void
  {
		$thumb = str_replace($_SERVER['DOCUMENT_ROOT'],'',$srcsetLocalImage);
	  $slot = min($maxWidth, $newWidth);
	  $this->sizes[] = sprintf("(max-width: %spx) %spx", $newWidth, $slot);
		$this->srcset[] = sprintf("%s %sw", $thumb, $newWidth);
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
			$baseAttributes['src'] = $this->src;
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
