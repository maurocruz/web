<?php

declare(strict_types=1);

namespace Plinct\Web\Fragment\Breadcrumb;

interface BreadcrumbInterface
{
    /**
     * arrau or json or null
     *
     * @param string|null $breadcrumbSchema
     * @return BreadcrumbInterface
     */
    public function setBreadcrumb(string $breadcrumbSchema = null): BreadcrumbInterface;

    /**
     * @param array $attributes
     * @return BreadcrumbInterface
     */
    public function attributes(array $attributes): BreadcrumbInterface;

    public function setUrl(string $url): BreadcrumbInterface;

    public function getNavbar(): string;

    public function getBreadcrumb(): string;
}