<?php
namespace Plinct\Web\Template;

use Plinct\Web\Interfaces\ResourceInterface;
use Plinct\Web\Render;
use Plinct\Web\Resource\Resource;
use Plinct\Web\Widget\Scrollup;

class WebSite extends TemplateAbstract {
    const JQUERY_SRC = "https://code.jquery.com/jquery-3.3.1.min.js";
    const REQUEST_SRC = "https://pirenopolis.tur.br/App/static/js/requests.js";
    const IMAGE_GALLERY_SRC = "https://pirenopolis.tur.br/App/static/js/imageGallery.js";
    private $scrollUp;

    public function __construct() {
        parent::__construct();
        parent::append('head', '<meta charset="utf-8">');
        parent::append('head', '<meta name="viewport" content="width=device-width">');
    }

    public function setTitle($title) {
        parent::append('head', [ "tag" => "title", "content" => $title ]);
    }

    public function setDescription($description) {
        parent::append('head', [ "tag" => "meta", "attributes" => [ "name" => "description", "content" => $description ]]);
    }

    public function setStyleMin(string $file) {
        parent::append('head', [ "tag" => "style", "content" => file_get_contents($file)]);
    }

    public function setStyle(string $href) {
        parent::append('head', [ "tag" => "link", "attributes" => [ "href" => $href, "type" => "text/css", "rel" => 'stylesheet']]);
    }
    public function setScriptJs(string $src) {
        parent::append('head', [ "tag" => "script", "attributes" => [ "src" => $src, "type" => "text/javascript"] ]);
    }

    public function buildStructure($elementParent, $elementChild, array $atributesElementChild = null) {
        if (property_exists($this,$elementChild)) {
            $this->{$elementParent}['content'][] = $this->{$elementChild};
        }
    }

    public function enableImageGallery() {
        $this->attributes('main', [ "id" => "main" ]);
        $this->append('head', [ "tag" => "script", "attributes" => [ "src" => self::JQUERY_SRC ]]);
        $this->append('head', [ "tag" => "script", "attributes" => [ "src" => self::REQUEST_SRC ]]);
        $this->append('head', [ "tag" => "script", "attributes" => [ "src" => self::IMAGE_GALLERY_SRC ]]);
    }

    public function enableScrollUp() {
        $this->scrollUp = true;
    }

    public function append(string $element, $content, int $position = null) {
        parent::append($element, $content, $position);
    }
    public function attributes(string $element, array $attributes) {
        if (isset($this->{$element}['attributes'])) {
            $this->{$element}['attributes'] = array_merge($this->{$element}['attributes'], $attributes);
        } else {
            $this->{$element}['attributes'] = $attributes;
        }
    }

    public function uri(): ResourceInterface {
        return (new Resource())->uri();
    }

    public final function ready(): string {
        if ($this->scrollUp) {
            parent::append('body', Scrollup::addButton());
        }
        parent::minimum();
        return "<!DOCTYPE>".Render::arrayToString($this->html);
    }
}