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
		return '<span class="iconify" data-icon="ic:sharp-broken-image" style="color: #a2a2a2;" data-width="'.$width.'"></span>';
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
	 * @return string
	 */
  public function whatsapp(): string
  {
   return (new SocialIcons())->whatsapp();
  }
}
