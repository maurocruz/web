<?php

declare(strict_types=1);

namespace Plinct\Web\WebSite;

interface WebSiteInterface
{
    /**
     * @param array $head
     * @return mixed
     */
    public function head(array $head);

    /**
     * @param array $body
     * @return mixed
     */
    public function body(array $body);

    /**
     * @return mixed
     */
    public function ready();

    /**
     * @return string
     */
    public function run(): string;
}
