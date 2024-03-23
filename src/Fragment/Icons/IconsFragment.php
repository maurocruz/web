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
	public function config(): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" width="1.4em" height="1.4em" viewBox="0 0 32 32"><path fill="#99b8c4" d="m23.265 24.381l.9-.894c4.164.136 4.228-.01 4.411-.438l1.144-2.785l.085-.264l-.093-.231c-.049-.122-.2-.486-2.8-2.965V15.5c3-2.89 2.936-3.038 2.765-3.461l-1.139-2.814c-.171-.422-.236-.587-4.37-.474l-.9-.93a20.166 20.166 0 0 0-.141-4.106l-.116-.263l-2.974-1.3c-.438-.2-.592-.272-3.4 2.786l-1.262-.019c-2.891-3.086-3.028-3.03-3.461-2.855L9.149 3.182c-.433.175-.586.237-.418 4.437l-.893.89c-4.162-.136-4.226.012-4.407.438l-1.146 2.786l-.09.267l.094.232c.049.12.194.48 2.8 2.962v1.3c-3 2.89-2.935 3.038-2.763 3.462l1.138 2.817c.174.431.236.584 4.369.476l.9.935a20.243 20.243 0 0 0 .137 4.1l.116.265l2.993 1.308c.435.182.586.247 3.386-2.8l1.262.016c2.895 3.09 3.043 3.03 3.466 2.859l2.759-1.115c.436-.173.588-.234.413-4.436m-11.858-6.524a4.957 4.957 0 1 1 6.488 2.824a5.014 5.014 0 0 1-6.488-2.824"/></svg>';
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
    return '<svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 20 20"><path fill="currentColor" d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8z"/></svg>';
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
