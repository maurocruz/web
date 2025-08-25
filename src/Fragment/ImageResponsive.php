<?php
namespace Plinct\Web\Fragment;

use Exception;
use Imagick;
use InvalidArgumentException;

class ImageResponsive
{
	private string $large;
	private ?string $href = null;
	private string $alt = 'Imagem responsiva';
	private string $srcSet;
	private string $sizes;
	private ?string $error = null;
	private string $destination = './public/uploads/images/';

	public function __construct(string $contentUrl)
	{
		$this->large = $contentUrl;
		return $this;
	}

	/**
	 * @param string|null $href
	 * @return ImageResponsive
	 */
	public function setHref(?string $href): static
	{
		$this->href = $href;
		return $this;
	}

	/**
	 * @param string $alt
	 * @return ImageResponsive
	 */
	public function setAlt(string $alt): static
	{
		$this->alt = $alt;
		return $this;
	}

	/**
	 * @param string $destination
	 * @return $this
	 */
	public function setDestination(string $destination): static
	{
		$this->destination = $destination;
		return $this;
	}

	public function imagemResponsive(): void
	{
		try {
			$images = $this->getImagesFormat($this->large);
			$medium = $images['m']; // 791
			$small = $images['s']; // 489
			$thumb = $images['t']; // 302

			// if thumb not found
			$headerThumb = @get_headers($thumb);
			if ($headerThumb && $headerThumb[0] == 'HTTP/1.1 404 Not Found') {
				$thumb = $this->createThumb($this->large, 'thumb');
			}
			$this->srcSet = "$thumb 302w, $this->large 489w";
			$this->sizes = "(max-width: 320px) 302px, 489px";

			// is small not found
			$headerSmall = @get_headers($small);
			if ($headerSmall && $headerSmall[0] == 'HTTP/1.1 404 Not Found') {
				$small = $this->createThumb($this->large, 'small');
			}
			$this->srcSet = "$thumb 302w, $small 489w, $this->large 791w";
			$this->sizes = "(max-width: 320px) 302px, (max-width: 489px) 489px, 791px";

			// is medium not found?
			$headerMedium = @get_headers($medium);
			if ($headerMedium && $headerMedium[0] == 'HTTP/1.1 404 Not Found') {
				$medium = $this->createThumb($this->large, 'medium');
			}
			$this->srcSet = "$medium 302w, $small 489w, $medium 791w, $this->large 1280w";
			$this->sizes = "(max-width: 320px) 302px, (max-width: 489px) 489px, (max-width: 791px) 791px, 1280px";

		} catch (Exception $e) {
			$this->error = "<!-- Erro ao gerar imagem responsiva: {$e->getMessage()} -->";
		}
	}

	/**
	 * @param $url
	 * @return string[]
	 */
	private function getImagesFormat($url): array
	{
		$parsedUrl = parse_url($url);
		if (!isset($parsedUrl['path'])) {
			throw new InvalidArgumentException("URL inválida.");
		}

		$schema = $parsedUrl['scheme'] ?? $_SERVER['REQUEST_SCHEME'];
		$host = $parsedUrl['host'] ?? $_SERVER['HTTP_HOST'];

		$path = $parsedUrl['path'];
		$pathParts = explode('/', $path);
		$fileName = array_pop($pathParts);

		$dotIndex = strrpos($fileName, '.');
		if ($dotIndex === false) {
			throw new InvalidArgumentException("A URL não contém uma extensão de arquivo válida.");
		}

		$baseName = substr($fileName, 0, $dotIndex);
		$extension = substr($fileName, $dotIndex);
		$prefixPath = implode('/', $pathParts);
		$origin = "$schema://$host";

		$gerarURL = function ($sufixo) use ($origin, $prefixPath, $baseName, $extension) {
			return $origin . $prefixPath . '/' . $baseName . $sufixo . $extension;
		};

		return [
			'm' => $gerarURL('_m'),
			's' => $gerarURL('_s'),
			't' => $gerarURL('_t')
		];
	}

	/**
	 * @throws Exception
	 */
	function createThumb($imagePath, $width = 'large', $crop = 1.0): string
	{
		if (!extension_loaded('imagick')) {
			throw new Exception("A extensão Imagick não está habilitada.");
		}

		if ($crop < 0.1 || $crop > 1.0) {
			throw new Exception("O índice de corte deve estar entre 0.1 e 1.0.");
		}

		$info = pathinfo($imagePath);
		$ext  = strtolower($info['extension']);
		$name = $info['filename'];
		$hash = md5($name);
		$dataHora = date('Ymd_His');


		// Inclui também a imagem original cortada
		$imOriginal = new Imagick($imagePath);
		$w = $imOriginal->getImageWidth();
		$h = $imOriginal->getImageHeight();

		// Calcula altura de corte
		$novaAltura = (int)($h * $crop);
		$topo = (int)(($h - $novaAltura) / 2); // centralizar corte

		// Aplica corte na original
		$imOriginal->cropImage($w, $novaAltura, 0, $topo);
		$imOriginal->setImagePage(0, 0, 0, 0);

		// Salva original cortada com prefixo 'o'
		$nomeOriginal = "{$dataHora}_{$hash}_o.{$ext}";
		$imOriginal->writeImage($this->destination . $nomeOriginal);

		$tamanho = match ($width) {
			'large' => 1280,
			'medium' => 791,
			'small' => 489,
			'thumb' => 302
		};
		$prefix = match ($width) {
			'large' => 'l',
			'medium' => 'm',
			'small' => 's',
			'thumb' => 't'
		};

		$imOriginal->resizeImage($tamanho, 0, Imagick::FILTER_LANCZOS, 1);
		$nomeArquivo = "{$dataHora}_{$hash}_{$prefix}.{$ext}";
		$imOriginal->writeImage($this->destination . $nomeArquivo);
		$imOriginal->clear();

		return $this->destination . $nomeArquivo;
	}

	final public function render(): string
	{
		$this->imagemResponsive();

		if ($this->error) {
			var_dump($this->error);
		}

		$returns = "";
		if ($this->href) {
			$returns .= "<a href='$this->href'>";
		}
		$returns .= "<img src='$this->large' srcset='$this->srcSet' sizes='$this->sizes' alt='$this->alt' />";
		if ($this->href) {
			$returns .= "</a>";
		}
		return $returns;
	}
}
