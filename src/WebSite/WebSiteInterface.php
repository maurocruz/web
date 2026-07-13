<?php
namespace Plinct\Web\WebSite;

interface WebSiteInterface
{
	/**
	 * @param array $head
	 * @return void
	 */
    public function head(array $head): void;

	/**
	 * @param $content
	 * @return void
	 */
    public function addHead($content): void;

	/**
	 * @param array $body
	 * @return void
	 */
    public function body(array $body): void;

	/**
	 * @return void
	 */
    public function ready(): void;

    /**
     * @return string
     */
    public function run(): string;
}
