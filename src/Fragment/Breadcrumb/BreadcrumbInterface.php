<?php
namespace Plinct\Web\Fragment\Breadcrumb;

interface BreadcrumbInterface
{
	/**
	 * arrau or json or null
	 *
	 * @param string $breadcrumbSchema
	 * @return BreadcrumbInterface
	 */
    public function setBreadcrumb(string $breadcrumbSchema): BreadcrumbInterface;

    /**
     * @param array $attributes
     * @return BreadcrumbInterface
     */
    public function attributes(array $attributes): BreadcrumbInterface;

    /**
     * @param string $url
     * @return BreadcrumbInterface
     */
    public function setUrl(string $url): BreadcrumbInterface;

    /**
     * @param array|null $baseBreadcrumb
     * @param bool $byRequestUri
     * @return string
     */
    public function getNavbar(array $baseBreadcrumb = null, bool $byRequestUri = true): string;

    /**
     * @return string
     */
    public function getBreadcrumb(): string;
}
