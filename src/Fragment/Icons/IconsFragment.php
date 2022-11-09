<?php

declare(strict_types=1);

namespace Plinct\Web\Fragment\Icons;

class IconsFragment
{
	/**
	 * @return string
	 */
	public function arrowBack(): string
	{
		return "<span class='iconify' style='font-size: 2em; cursor: pointer;' data-icon='akar-icons:arrow-back-thick' onclick='history.back();'></span>";
	}

	/**
	 * @return string
	 */
	public function backward(): string
	{
		return "<span class='iconify' data-icon='zondicons:backward'></span>";
	}

	/**
	 * @return string
	 */
	public function backwardStep(): string
	{
		return "<span class='iconify' data-icon='zondicons:backward-step'></span>";
	}

	/**
	 * @return string
	 */
	public function delete(): string
	{
		return "<span class='iconify menu-tab-icon icon-delete' data-icon='ic:round-delete-forever'></span>";
	}

	/**
	 * @return string
	 */
	public function edit(): string
	{
		return "<span class='iconify menu-tab-icon icon-edit' data-icon='fa-solid:edit'></span>";
	}

	/**
	 * @return string
	 */
	public function forward(): string
	{
		return "<span class='iconify' data-icon='zondicons:forward'></span>";
	}

	/**
	 * @return string
	 */
	public function forwardStep(): string
	{
		return "<span class='iconify' data-icon='zondicons:forward-step'></span>";
	}
  /**
   * @return string
   */
  public function home(): string
  {
    return "<span class='iconify menu-tab-icon icon-home' data-icon='ci:home-alt-fill'></span>";
  }

	/**
	 * @param int $width
	 * @return string
	 */
	public function noImage(int $width = 100): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M21 3v8.59l-3-3.01l-4 4.01l-4-4l-4 4l-3-3.01V3h18zm-3 8.42l3 3.01V21H3v-8.58l3 2.99l4-4l4 4l4-3.99z"/></svg>';
	}

  /**
   * @return string
   */
  public function plus(): string
  {
    return "<span class='iconify menu-tab-icon icon-plus' data-icon='akar-icons:plus'></span>";
  }

  /**
   * @return string
   */
  public function send(): string
  {
    return '<span class="iconify form-submit-button form-submit-button-send" data-icon="mdi:send"></span>';
  }

	/**
	 * @return SocialIcons
	 */
	public function socialIcons(): SocialIcons
	{
		return new SocialIcons();
	}

	/**
	 * @param string|null $phonenumber
	 * @return string
	 */
	public function telephone(string $phonenumber = null): string
	{
		$svg = '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="#1769aa" fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42a18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg>';
		return $phonenumber ? "<a href='tel:$phonenumber'>$svg</a>" : $svg;
	}

	/**
	 * @param string|null $phonenumber
	 * @return string
	 */
  public function whatsapp(string $phonenumber = null): string
  {
   return (new SocialIcons())->whatsapp($phonenumber);
  }
}
