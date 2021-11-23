<?php

declare(strict_types=1);

namespace Plinct\Web\WebSite;

use Plinct\Tool\Locale;

abstract class WebSiteAbstract
{
    private array $html;
    private static array $head;
    private static array $body;

    public function __construct() {
        $this->html = [ "tag" => "html", "attributes" => [ "lang" => Locale::getServerLanguage() ] ];
        self::$head = [ "tag" => "head" ];
        self::$body = [ "tag" => "body" ];

        self::$head['content'][] = '<meta charset="utf-8">';
        self::$head['content'][] = '<meta name="viewport" content="width=device-width">';
    }

    /**
     * @param array|string[] $head
     */
    protected static function setHead(array $head): void
    {
        self::$head = $head;
    }

    /**
     * @return array|string[]
     */
    protected static function getHead(): array
    {
        return self::$head;
    }

    /**
     * @return array|string[]
     */
    protected static function getBody(): array
    {
        return self::$body;
    }

    /**
     * @param array|string[] $body
     */
    public static function setBody(array $body): void
    {
        self::$body = $body;
    }

    /**
     * @param array|null $attributes

    protected static function setWrapper(?array $attributes)
    {
        self::$wrapper = [ "tag" => "div", "attributes" => $attributes ?? [ "class" => "wrapper"] ];
    }*/

    /**
     * @param array|null $attributes

    protected static function setContainer(?array $attributes)
    {
        self::$container = [ "tag" => "div", "attributes" => $attributes ?? [ "class" => "container"] ];;
    }*/

    /**
     * @param array|null $attributes

    protected static function setHeader(?array $attributes): void
    {
        self::$header = [ "tag" => "header", "attributes" => $attributes ?? [ "class" => "header"] ];
    }*/

    /**
     * @return array
     */
    protected function getHtml(): array
    {
        $this->html['content'] = [
            self::getHead(),
            self::getBody()
        ];

        return $this->html;
    }

}