<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

class Video extends ElementAbstract
{
	/**
	 * @param array|null $attributes
	 */
	public function __construct(array $attributes = null)
	{
		$this->setElement('video');
		$this->attributes($attributes);
	}

	/**
	 * @return $this
	 */
	public function autoplay(): Video
	{
		$this->setAttribute('autoplay');
		return $this;
	}

	/**
	 * @return $this
	 */
	public function controls(): Video
	{
		$this->setAttribute('controls');
		return $this;
	}

	/**
	 * @param string $src
	 * @return $this
	 */
	public function src(string $src): Video
	{
		$this->setAttribute('src',$src);
		return $this;
	}
}