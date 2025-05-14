<?php
namespace Plinct\Web\Fragment;

use Exception;
use InvalidArgumentException;

class ImageResponsive
{
	private function gerarVariacoesDeImagem($url): array
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
			$prefix = $prefixPath ? '/' . $prefixPath : '';
			return $origin . $prefix . '/' . $baseName . $sufixo . $extension;
		};

		return [
			'm' => $gerarURL('_m'),
			's' => $gerarURL('_s'),
			't' => $gerarURL('_t')
		];
	}

	public function imagemResponsive(string $urlOriginal, string $alt = 'Imagem responsiva', string|null $rel = null): string
	{
		try {
			$images = $this->gerarVariacoesDeImagem($urlOriginal);
			$large = $urlOriginal; // 1280
			$medium = $images['m']; // 791
			$small = $images['s']; // 489
			$thumb = $images['t']; // 302

			$headerThumb = @get_headers($thumb);
			if ($headerThumb && $headerThumb[0] == 'HTTP/1.1 404 Not Found') {
				if($rel) {
					return <<<HTML
 <a href="$rel"><img src="$large" alt="$alt" /></a>
 HTML;
				} else {
					return <<<HTML
 <img src="$large" alt="$alt" />
 HTML;
				}
			} else {
				$srcSet = "$thumb 302w, $large 489w";
				$sizes = "(max-width: 320px) 302px, 489px";

				$headerSmall = @get_headers($small);
				if (isset($headerSmall[0]) && $headerSmall[0] == 'HTTP/1.1 200 OK') {
					$srcSet = "$thumb 302w, $small 489w, $large 791w";
					$sizes = "(max-width: 320px) 302px, (max-width: 489px) 489px, 791px";

					$headerMedium = @get_headers($medium);
					if (isset($headerMedium[0]) && $headerMedium[0] == 'HTTP/1.1 200 OK') {
						$srcSet = "$medium 302w, $small 489w, $medium 791w, $large 1280w";
						$sizes = "(max-width: 320px) 302px, (max-width: 489px) 489px, (max-width: 791px) 791px, 1280px";
					}
				}
			}
			if ($rel) {
				return <<<HTML
<a href="$rel"><img 
    src="$large" 
    srcset="$srcSet" 
    sizes="$sizes" 
    alt="$alt" /></a>
HTML;
			} else {
				return <<<HTML
<img 
    src="$large" 
    srcset="$srcSet" 
    sizes="$sizes" 
    alt="$alt" >
HTML;
			}

		} catch (Exception $e) {
			return "<!-- Erro ao gerar imagem responsiva: {$e->getMessage()} -->";
		}
	}

}
