<?php

declare(strict_types=1);

namespace Plinct\Web;

use Plinct\Web\WebSite\WebSite;
use Plinct\Web\WebSite\WebSiteInterface;

class WebSiteFactory
{
    /**
     * @return WebSiteInterface
     */
    public static function create(): WebSiteInterface
    {
        return new WebSite();
    }
}
