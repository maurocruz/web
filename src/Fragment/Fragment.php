<?php

declare(strict_types=1);

namespace Plinct\Web\Fragment;

use Plinct\Web\Element\Figure;
use Plinct\Web\Fragment\Breadcrumb\Breadcrumb;
use Plinct\Web\Fragment\Breadcrumb\BreadcrumbInterface;
use Plinct\Web\Widget\Scrollup;

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
     * @param array|null $attributes
     * @return Figure
     */
    public static function figure(array $attributes = null): Figure
    {
        return new Figure($attributes);
    }

    /**
     * @return IconsFragment
     */
    public static function icons(): IconsFragment
    {
        return new IconsFragment();
    }

    /**
     * @param string $jsonSchema
     * @return string
     */
    public static function scriptJsonLd(string $jsonSchema): string
    {
        return "<script type='application/ld+json'>$jsonSchema</script>";
    }

    public static function scrollup(): Scrollup
    {
        return new Scrollup();
    }
}
