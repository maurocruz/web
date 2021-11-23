<?php

declare(strict_types=1);

namespace Plinct\Web\WebSite;

use Plinct\Tool\Locale;

abstract class WebSiteAbstract
{
    /**
     * @var array
     */
    private array $html;
    /**
     * @var string[]
     */
    private array $head;
    /**
     * @var string[]
     */
    private array $body;

    /**
     *
     */
    public function __construct()
    {
        $this->html = [ "tag" => "html", "attributes" => [ "lang" => Locale::getServerLanguage() ] ];
        $this->head = [ "tag" => "head" ];
        $this->body = [ "tag" => "body" ];

        $this->head['content'][] = '<meta charset="utf-8">';
        $this->head['content'][] = '<meta name="viewport" content="width=device-width">';
    }


    /**
     * @param array|string[] $head
     */
    protected function setHead(array $head)
    {
        $this->head = $head;
    }

    /**
     * @return array|string[]
     */
    protected function getHead(): array
    {
        return $this->head;
    }

    /**
     * @return array|string[]
     */
    protected function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array|string[] $body
     */
    protected function setBody(array $body): void
    {
        $this->body = $body;
    }

    /**
     * @return array
     */
    protected function getHtml(): array
    {
        $this->html['content'] = [
            $this->getHead(),
            $this->getBody()
        ];

        return $this->html;
    }
}
