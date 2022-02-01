<?php

declare(strict_types=1);

namespace Plinct\Web\Fragment\Breadcrumb;

abstract class BreadcrumbAbstract
{
    /**
     * @var array|null
     */
    protected ?array $listWrapper = null;
    /**
     * @var array|null
     */
    protected ?array $listItem = null;
    /**
     * @var array|null
     */
    protected ?array $attributes = null;
    /**
     * @var array|null
     */
    protected ?array $breadcrumb = null;
    /**
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * @param array|null $attributes
     */
    protected function setAttributes(?array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     */
    protected function setListWrapper(): void
    {
        $this->listWrapper = ['tag'=>'ol','attributes'=>$this->attributes];
    }

    /**
     * @param string $href
     * @param string $name
     * @return void
     */
    private function setItemList(string $href, string $name)
    {
        $this->listWrapper['content'][] = "<li><a href='$href'>$name</a></li>";
    }

    /**
     * @return array
     */
    protected function getListWrapper(): array
    {
        return $this->listWrapper;
    }

    /**
     * @param null $baseBreadcrumb
     * @param bool $byRequestUri
     * @return void
     */
    protected function setListItems($baseBreadcrumb = null, bool $byRequestUri = true)
    {
        if ($baseBreadcrumb) {
            foreach ($baseBreadcrumb as $keyBB => $valueBB) {
                $this->setItemList($keyBB, $valueBB);
            }
        }

        if ($this->breadcrumb) {
            foreach ($this->breadcrumb['itemListElement'] as $value) {
                $this->setItemList($value['item']['@id'], $value['item']['name']);
            }
        } elseif ($byRequestUri) {
            $explodeUri = array_filter(explode('/',filter_input(INPUT_SERVER,'REQUEST_URI')));

            foreach ($explodeUri as $valueUrl) {
                $this->setItemList($valueUrl, ucfirst($valueUrl));
            }
        }
    }
}
