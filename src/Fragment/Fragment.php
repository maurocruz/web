<?php

declare(strict_types=1);

namespace Plinct\Web\Fragment;

use Plinct\Web\Fragment\Breadcrumb\Breadcrumb;
use Plinct\Web\Fragment\Breadcrumb\BreadcrumbInterface;

class Fragment
{
    /**
     * @return BreadcrumbInterface
     */
    public static function breadcrumb(): BreadcrumbInterface
    {
        return new Breadcrumb();
    }

    /**
     * @param string $jsonSchema
     * @return string
     */
    public static function scriptJsonLd(string $jsonSchema): string
    {
        return "<script type='application/ld+json'>$jsonSchema</script>";
    }
}
