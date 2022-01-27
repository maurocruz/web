<?php

declare(strict_types=1);

namespace Plinct\Web\WebSite;

use Plinct\Web\Render;

class WebSite extends WebSiteAbstract implements WebSiteInterface
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array|string[] $head
     */
    public function head(array $head)
    {
        $this->setHead($head);
    }

    public function addHead($content)
    {
        $this->head['content'][] = $content;
    }

    /**
     * @param array $body
     */
    public function body(array $body)
    {
        $this->setBody($body);
    }

    /**
     *
     */
    public function ready()
    {
        echo $this->run();
    }

    public function run(): string
    {
        return "<!DOCTYPE html>" . Render::arrayToString($this->getHtml());
    }
}
