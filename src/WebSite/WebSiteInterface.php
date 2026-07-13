<?php
namespace Plinct\Web\WebSite;

interface WebSiteInterface
{
    /**
     * @param array $head
     * @return mixed
     */
    public function head(array $head): mixed;

    /**
     * @param $content
     * @return mixed
     */
    public function addHead($content): mixed;

    /**
     * @param array $body
     * @return mixed
     */
    public function body(array $body): mixed;

    /**
     * @return mixed
     */
    public function ready(): mixed;

    /**
     * @return string
     */
    public function run(): string;
}
