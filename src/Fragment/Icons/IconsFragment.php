<?php
namespace Plinct\Web\Fragment\Icons;

class IconsFragment
{
	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public function action(int $width = 16, int $height = 16): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 416 512"><title>'._('Action').'</title><path fill="currentColor" d="M272 96c26.51 0 48-21.49 48-48S298.51 0 272 0s-48 21.49-48 48s21.49 48 48 48M113.69 317.47l-14.8 34.52H32c-17.67 0-32 14.33-32 32s14.33 32 32 32h77.45c19.25 0 36.58-11.44 44.11-29.09l8.79-20.52l-10.67-6.3c-17.32-10.23-30.06-25.37-37.99-42.61M384 223.99h-44.03l-26.06-53.25c-12.5-25.55-35.45-44.23-61.78-50.94l-71.08-21.14c-28.3-6.8-57.77-.55-80.84 17.14l-39.67 30.41c-14.03 10.75-16.69 30.83-5.92 44.86s30.84 16.66 44.86 5.92l39.69-30.41c7.67-5.89 17.44-8 25.27-6.14l14.7 4.37l-37.46 87.39c-12.62 29.48-1.31 64.01 26.3 80.31l84.98 50.17l-27.47 87.73c-5.28 16.86 4.11 34.81 20.97 40.09c3.19 1 6.41 1.48 9.58 1.48c13.61 0 26.23-8.77 30.52-22.45l31.64-101.06c5.91-20.77-2.89-43.08-21.64-54.39l-61.24-36.14l31.31-78.28l20.27 41.43c8 16.34 24.92 26.89 43.11 26.89H384c17.67 0 32-14.33 32-32s-14.33-31.99-32-31.99"/></svg>';

	}
	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public function arrowBack(int $width = 24, int $height = 24): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 24 24" style="cursor: pointer;" onclick="history.back();"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m2 11l7-9v5c11.953 0 13.332 9.678 13 15c-.502-2.685-.735-7-13-7v5z"/></svg>';
	}

	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public function backward(int $width = 24, int $height = 24): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 20 20"><path fill="currentColor" d="M19 5v10l-9-5zm-9 0v10l-9-5z"/></svg>';
	}

	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public function backwardStep(int $width = 24, int $height = 24): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 20 20"><path fill="currentColor" d="M4 5h3v10H4zm12 0v10l-9-5z"/></svg>';
	}

	/**
	 * @return string
	 */
	public function config(): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" width="1.4em" height="1.4em" viewBox="0 0 32 32"><title>'._('Configuration').'</title><path fill="#99b8c4" d="m23.265 24.381l.9-.894c4.164.136 4.228-.01 4.411-.438l1.144-2.785l.085-.264l-.093-.231c-.049-.122-.2-.486-2.8-2.965V15.5c3-2.89 2.936-3.038 2.765-3.461l-1.139-2.814c-.171-.422-.236-.587-4.37-.474l-.9-.93a20.166 20.166 0 0 0-.141-4.106l-.116-.263l-2.974-1.3c-.438-.2-.592-.272-3.4 2.786l-1.262-.019c-2.891-3.086-3.028-3.03-3.461-2.855L9.149 3.182c-.433.175-.586.237-.418 4.437l-.893.89c-4.162-.136-4.226.012-4.407.438l-1.146 2.786l-.09.267l.094.232c.049.12.194.48 2.8 2.962v1.3c-3 2.89-2.935 3.038-2.763 3.462l1.138 2.817c.174.431.236.584 4.369.476l.9.935a20.243 20.243 0 0 0 .137 4.1l.116.265l2.993 1.308c.435.182.586.247 3.386-2.8l1.262.016c2.895 3.09 3.043 3.03 3.466 2.859l2.759-1.115c.436-.173.588-.234.413-4.436m-11.858-6.524a4.957 4.957 0 1 1 6.488 2.824a5.014 5.014 0 0 1-6.488-2.824"/></svg>';
	}

	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public function delete(int $width = 24, int $height = 24): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 24 24"><path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6zm3.17-6.41a.996.996 0 1 1 1.41-1.41L12 12.59l1.41-1.41a.996.996 0 1 1 1.41 1.41L13.41 14l1.41 1.41a.996.996 0 1 1-1.41 1.41L12 15.41l-1.41 1.41a.996.996 0 1 1-1.41-1.41L10.59 14zM18 4h-2.5l-.71-.71c-.18-.18-.44-.29-.7-.29H9.91c-.26 0-.52.11-.7.29L8.5 4H6c-.55 0-1 .45-1 1s.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1"/></svg>';
	}

	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public function edit(int $width = 24, int $height = 24): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 576 512"><path fill="currentColor" d="m402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0m162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2M384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5"/></svg>';
	}

	/**
	 * @param string|null $uri
	 * @param string $width
	 * @param string $height
	 * @param string $color
	 * @return string
	 */
	public function email(string $uri = null, string $width = '1em', string $height = '1em', string $color = "#FFFFFF"): string
	{
		$icon = '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 24 24"><path fill="'.$color.'" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z"/></svg>';
		return $uri ? "<a href='$uri' target='_blank'>$icon</a>" : $icon;
	}

	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public function forward(int $width = 24, int $height = 24): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 20 20"><path fill="currentColor" d="m1 5l9 5l-9 5zm9 0l9 5l-9 5z"/></svg>';
	}

	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public function forwardStep(int $width = 24, int $height = 24): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 20 20"><path fill="currentColor" d="M13 5h3v10h-3zM4 5l9 5l-9 5z"/></svg>';
	}

	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
  public function home(int $width = 16, int $height = 16): string
  {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 20 20"><title>'._('Home').'</title><path fill="currentColor" d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8z"/></svg>';
  }

	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	public function noImage(int $width = 24, int $height = 24): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="'.$width.'" height="'.$height.'" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M21 3v8.59l-3-3.01l-4 4.01l-4-4l-4 4l-3-3.01V3h18zm-3 8.42l3 3.01V21H3v-8.58l3 2.99l4-4l4 4l4-3.99z"/></svg>';
	}

	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
  public function plus(int $width = 16, int $height = 16): string
  {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 24 24"><title>'._('Plus').'</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 20v-8m0 0V4m0 8h8m-8 0H4"/></svg>';
  }

	public function sitemap(int $width = 16, int $height = 16): string
	{
		return '<svg xmlns="http://www.w3.org/2000/svg"  width="'.$width.'" height="'.$height.'" viewBox="0 0 1792 1536"><path fill="currentColor" d="M1792 1120v320q0 40-28 68t-68 28h-320q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h96V832H960v192h96q40 0 68 28t28 68v320q0 40-28 68t-68 28H736q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h96V832H320v192h96q40 0 68 28t28 68v320q0 40-28 68t-68 28H96q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h96V832q0-52 38-90t90-38h512V512h-96q-40 0-68-28t-28-68V96q0-40 28-68t68-28h320q40 0 68 28t28 68v320q0 40-28 68t-68 28h-96v192h512q52 0 90 38t38 90v192h96q40 0 68 28t28 68"/></svg>';
	}

	/**
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
  public function send(int $width = 24, int $height = 24): string
  {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" viewBox="0 0 24 24"><path fill="currentColor" d="m2 21l21-9L2 3v7l15 2l-15 2z"/></svg>';
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
