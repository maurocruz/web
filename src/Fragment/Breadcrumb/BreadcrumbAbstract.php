<?php

declare(strict_types=1);

namespace Plinct\Web\Fragment\Breadcrumb;

abstract class BreadcrumbAbstract
{
    protected array $listWrapper;

    protected array $listItem;

    protected ?array $attributes = null;

    protected ?array $breadcrumb = null;

    protected string $url;

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

    protected function setListItems()
    {
        foreach ($this->breadcrumb['itemListElement'] as $value) {
            $this->setItemList($value['item']['@id'], $value['item']['name']);
        }
    }
}
