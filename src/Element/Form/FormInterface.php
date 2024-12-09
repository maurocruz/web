<?php
namespace Plinct\Web\Element\Form;

use Plinct\Web\Element\ElementInterface;

interface FormInterface
{
  /**
   * @param string $url
   * @return FormInterface
   */
  public function action(string $url): FormInterface;

  /**
   * @param string $method
   * @return FormInterface
   */
  public function method(string $method): FormInterface;

	/**
	 * @param $content
	 * @return ElementInterface
	 */
	public function content($content): ElementInterface;

  /**
   * @param string $name
   * @param string $value
   * @param string $type
   * @param array|null $attributes
   * @return FormInterface
   */
  public function input(string $name, string $value, string $type = 'text', array $attributes = null): FormInterface;

  /**
   * @param $content
   * @param string|null $label
   * @param array|null $attributes
   * @return FormInterface
   */
  public function fieldset($content, string $label = null, array $attributes = null): FormInterface;

  /**
   * @param string $name
   * @param string|null $value
   * @param string|null $legend
   * @param string $type
   * @param array|null $attributes
   * @param array|null $attributesInput
   * @return FormInterface
   */
  public function fieldsetWithInput(string $name, string $value = null, string $legend = null, string $type = 'text', array $attributes = null, array $attributesInput = null ): FormInterface;

  /**
   * @param string $name
   * @param array | string $value
   * @param array $list
   * @param string|null $legend
   * @param array|null $attributes
   * @return FormInterface
   */
  public function fieldsetWithSelect(string $name, $value, array $list, string $legend = null, array $attributes = null): FormInterface;

  /**
   * @param string $name
   * @param string|null $value
   * @param string|null $legend
   * @param array|null $attributesFieldset
   * @param array $attributesTextarea
   * @return FormInterface
   */
  public function fieldsetWithTextarea(string $name, string $value = null, string $legend = null, array $attributesFieldset = null, array $attributesTextarea = []): FormInterface;

	public function fieldsetWithRadio(string $name, array $items, $valueChecked, string $legend = null): FormInterface;
  /**
   * @param string $id
   * @param string $editorName
   * @return mixed
   */
  public function setEditor(string $id, string $editorName = 'editor');

  /**
   * @param array|null $attributes
   * @return FormInterface
   */
  public function submitButtonSend(array $attributes = []): FormInterface;

  /**
   * @param string|null $formaction
   * @param array $attributes
   * @return FormInterface
   */
  public function submitButtonDelete(string $formaction = null, array $attributes = []): FormInterface;

  /**
   * @return array
   */
  public function ready(): array;
}