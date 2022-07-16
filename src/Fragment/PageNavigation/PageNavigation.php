<?php

declare(strict_types=1);

namespace Plinct\Web\Fragment\PageNavigation;

class PageNavigation extends PageNavigationAbstract
{

	/**
	 * @param array|null $attributes
	 */
	public function __construct(array $attributes = null)
	{
		$this->container['attributes'] = $attributes;
	}

	/**
	 * @param int $limit
	 * @param int $offset
	 * @param int $numberOfItems
	 * @return PageNavigation
	 */
	public function setNumbers(int $limit, int $offset, int $numberOfItems): PageNavigation
	{
		$this->limit = $limit;
		$this->offset = $offset;
		$this->numberOfItems = $numberOfItems;

		$this->numberOfPages = (int) ceil($numberOfItems / $limit);
		$this->activedPage = $offset == 0 ? 1 : (int) (($offset / $limit) + 1);

		$range = (int)floor(($offset / $this->limit) / $this->exposedPages);
		$this->firstRangePage = $range == 0 ? 1: $range * $this->exposedPages +1;
		$this->lastRangePage = $this->firstRangePage + $this->exposedPages - 1;
		if($this->lastRangePage > $this->numberOfPages) $this->lastRangePage = $this->numberOfPages;

		$this->lastOffset = ($this->numberOfPages * $limit) - $limit;

		return $this;
	}

	/**
	 * @param int $exposedPages
	 * @return PageNavigation
	 */
	public function setExposedPages(int $exposedPages): PageNavigation
	{
		$this->exposedPages = $exposedPages;
		return $this;
	}

	/**
	 * @return string[]
	 */
	public function ready(): array
	{
		parent::countPages();

		parent::selectLimit();

		parent::pageNumbering();

		return $this->container;
	}
}
