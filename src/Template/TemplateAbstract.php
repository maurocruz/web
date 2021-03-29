<?php
namespace Plinct\Web\Template;

use Plinct\Tool\Locale;

class TemplateAbstract {
    protected array $html;
    protected array $head;
    protected array $body;
    protected array $wrapper;
    protected array $container;
    protected array $header;
    protected array $content;
    protected array $contentHeader;
    protected array $main;
    protected array $contentFooter;
    protected array $aside;
    protected array $footer;

    public function __construct() {
        $this->html = [ "tag" => "html", "attributes" => [ "lang" => Locale::getServerLanguage() ] ];
        $this->head = [ "tag" => "head" ];
        $this->body = [ "tag" => "body" ];
        $this->wrapper = [ "tag" => "wrapper", "attributes" => [ "class" => "wrapper"] ];
        $this->container = [ "tag" => "div", "attributes" => [ "class" => "container"] ];
        $this->content = [ "tag" => "div", "attributes" => [ "class" => "content"] ];
        $this->aside = [ "tag" => "aside", "attributes" => [ "class" => "aside"] ];
        $this->header = [ "tag" => "header", "attributes" => [ "class" => "header"] ];
        $this->contentHeader = [ "tag" => "header", "attributes" => [ "class" => "content-header"] ];
        $this->main = [ "tag" => "main", "attributes" => [ "class" => "main"] ];
        $this->contentFooter = [ "tag" => "footer", "attributes" => [ "class" => "content-footer"] ];
        $this->footer = [ "tag" => "footer", "attributes" => [ "class" => "footer"] ];
    }

    protected function append(string $element, $content, int $position = null) {
        $_element = $this->{$element};
        $newContent = [];
        if (is_numeric($position) && isset($_element['content'])) {
            $newContent[$position] = $content;
            foreach ($_element['content'] as $key => $value) {
                if($key >= $position) {
                    $key = $key + 1;
                }
                $newContent[$key] = $value;
            }
            ksort($newContent);
            $this->{$element}['content'] = $newContent;
        } else {
            $this->{$element}['content'][] = $content;
        }
    }

    /**
     * HEAD && BODY
     */
    protected function minimum() {
        // HEAD
        $this->html['content'][] = $this->head;
        //BODY
        $this->html['content'][] = $this->body;
    }

    protected function simpleMain($header = false, $footer = null) {
        // CONTENT HEADER
        $this->content['content'][] = $this->header;
        // MAIN
        $this->content['content'][] = $this->main;
        // CONTENT FOOTER
        $this->content['content'][] = $this->footer;
        // CONTAINER
        $this->body['content'][] = $this->content;
        // HEAD & BODY
        $this->minimum();
    }

    protected function complete() {
        // CONTENT HEADER
        $this->content['content'][] = $this->contentHeader;
        // MAIN
        $this->content['content'][] = $this->main;
        // CONTENT FOOTER
        $this->content['content'][] = $this->contentFooter;
        // HEADER
        $this->wrapper['content'][] = $this->header;
        // CONTENT
        $this->container['content'][] = $this->content;
        // ASIDE
        $this->container['content'][] = $this->aside;
        // CONTAINER
        $this->wrapper['content'][] = $this->container;
        // FOOTER
        $this->wrapper['content'][] = $this->footer;
        // HEAD & BODY
        $this->minimum();
    }

}