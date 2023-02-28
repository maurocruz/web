<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

use Plinct\Web\Render;

class ListElement
{
  /**
   * @var string
   */
  private string $tag = 'ul';
  /**
   * @var array|null
   */
  private ?array $attributes = null;
  /**
   * @var array|null
   */
  private ?array $content = null;

  public function __construct(array $attributes = null)
  {
    $this->setAttributes($attributes);
  }

  /**
   * @param string $tag
   * @return ListElement
   */
  public function setTag(string $tag): ListElement
  {
    $this->tag = $tag;
    return $this;
  }

  /**
   * @param array|null $attributes
   * @return ListElement
   */
  public function setAttributes(?array $attributes): ListElement
  {
    $this->attributes = $attributes;
    return $this;
  }

	/**
	 * @param $content
	 * @param array|null $attributes
	 * @return $this
	 */
  public function addItem($content, array $attributes = null): ListElement
  {
    $this->content[] = ['tag'=>'li', 'attributes'=>$attributes, 'content'=>$content];
    return $this;
  }

	/**
	 * @return string
	 */
  public function ready(): string
  {
    return Render::arrayToString(['tag' => $this->tag, 'attributes'=>$this->attributes, 'content'=>$this->content]);
  }
}
