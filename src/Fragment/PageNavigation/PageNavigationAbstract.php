<?php

declare(strict_types=1);

namespace Plinct\Web\Fragment\PageNavigation;

use Plinct\Web\Fragment\Fragment;

class PageNavigationAbstract
{
	/**
	 * @var string[]
	 */
	protected $container = ['tag'=>'div'];
	/**
	 * @var int
	 */
	protected int $limit;
	/**
	 * @var int
	 */
	protected int $offset;
	/**
	 * @var int
	 */
	protected int $lastOffset;
	/**
	 * @var int
	 */
	protected int $numberOfItems;
	/**
	 * @var int
	 */
	protected int $numberOfPages;
	/**
	 * @var int
	 */
	protected int $exposedPages = 10;
	/**
	 * @var int
	 */
	protected int $firstRangePage = 1;
	/**
	 * @var int
	 */
	protected int $lastRangePage;
	/**
	 * @var int
	 */
	protected int $activedPage;

	/**
	 * @return void
	 */
	protected function countPages()
	{
		if ($this->numberOfItems < $this->limit) {
			$text = sprintf("%s %s %s",_("Showing"), $this->numberOfItems, _('items'));
		} else {
			$text = sprintf(_("Showing %s on page %s of %s occurrences in %s pages"), $this->limit, $this->activedPage, $this->numberOfItems, $this->numberOfPages);
		}
		$this->container['content'][] = "<div class='pageNavigation-countPages'>$text</div>";
	}

	protected function selectLimit(array $values = [40,80,120,160,200])
	{
		if ($this->numberOfItems > $this->limit) {
			$options = "<option value='$this->limit'>$this->limit</option>";
			foreach ($values as $value) {
				$options .= "<option value='$value'>$value</option>";
			}

			$this->container['content'][] = "<form class='pageNavigation-selectLimit' action='' method='get'>
				<input type='hidden' name='offset' value='$this->offset'/>
				<select name='limit' onchange='submit()'>$options</select>
			</form>";
		}
	}

	/**
	 * @return false|void
	 */
	protected function pageNumbering()
	{
		if ($this->numberOfPages <= 1) return false;

		$content = null;

		$href = "?limit=$this->limit";

		// FULL BACKWARD
		$content[] = $this->firstRangePage !== 1 ? " <a href='$href&offset=0' class='pageNavigation-ward pageNavigation-backward'>" . Fragment::icons()->backward() . "</a> " : null;

		// STEP BACKWARD
		$backwardOffset = $this->limit * ($this->firstRangePage - 2);
		$content[] = $this->firstRangePage > 1 ? " <a href='$href&offset=$backwardOffset' class='pageNavigation-ward pageNavigation-backwardStep'>" . Fragment::icons()->backwardStep() . "</a>" : null;

		// NUMBER PAGES
		for ($i = $this->firstRangePage; $i <= $this->lastRangePage; $i++) {
			$offset = $this->limit * ($i-1);
			$class = $this->activedPage == $i ? "pageNavigation-number pageNavigation-activedPage" : "pageNavigation-number pageNavigation-inactivedPage";
			$style =  $this->activedPage == $i ? "font-weight: bold; color: yellow;" : "";
			$content[] = " <a href='$href&offset=$offset' class='$class' style='$style'>".($i)."</a> ";
		}

		// STEP FORWARD
		$forwardOffset = $this->limit * ($i-1);
		$content[] = $this->lastRangePage < $this->numberOfPages ? " <a href='$href&offset=$forwardOffset' class='pageNavigation-ward pageNavigation-forwardStep'>" . Fragment::icons()->forwardStep() . "</a>" : null;

		// FULL FORWARD
		$content[] = $this->lastRangePage !== $this->numberOfPages ? " <a href='$href&offset=$this->lastOffset' class='pageNavigation-ward pageNavigation-forward'>" . Fragment::icons()->forward() . "</a> " : null;

		$this->container['content'][] = ['tag'=>'nav','attributes'=>['class'=>'pageNavigation-numbering'], 'content'=> $content ];
	}
}