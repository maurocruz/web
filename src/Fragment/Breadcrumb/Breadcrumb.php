<?php

declare(strict_types=1);

namespace Plinct\Web\Fragment\Breadcrumb;

use Plinct\Web\Debug\Debug;
use Plinct\Web\Render;

class Breadcrumb extends BreadcrumbAbstract implements BreadcrumbInterface
{
    /**
     * @param array $attributes
     * @return BreadcrumbInterface
     */
    public function attributes(array $attributes): BreadcrumbInterface
    {
        $this->setAttributes($attributes);
        return $this;
    }

    /**
     * @param string|null $breadcrumbSchema
     * @return BreadcrumbInterface
     */
    public function setBreadcrumb(string $breadcrumbSchema = null): BreadcrumbInterface
    {
        if ($breadcrumbSchema) {
            $withArray = json_decode($breadcrumbSchema, true);
            $this->breadcrumb = isset($withArray['@type']) && $withArray['@type'] == 'BreadcrumbList' ? $withArray : null;
        }

        return $this;
    }

    /**
     * @param string $url
     * @return BreadcrumbInterface
     */
    public function setUrl(string $url): BreadcrumbInterface
    {
        if (!$this->breadcrumb) {
            $breadcrumb = [
                '@context'=>'https://schema.org',
                '@type'=>'BreadcrumbList'
            ];

            $urlExplode = explode('/', $url);
            $urlRoot = $urlExplode[0] . '//' . $urlExplode[2];
            $href = $urlRoot;
            $breadcrumb['itemListElement'][] = ['@type'=>'ListItem','position'=>1, 'item'=>['@id'=>$href,'name'=>_('Home')]];

            for ($i = 3; $i < count($urlExplode); $i++) {
                $href = $href . DIRECTORY_SEPARATOR . $urlExplode[$i];
                $name = ucfirst($urlExplode[$i]);
                $breadcrumb['itemListElement'][] = ['@type'=>'ListItem','position'=> ($i-1) , 'item'=>['@id'=>$href,'name'=>$name]];
            }
            $this->breadcrumb = $breadcrumb;
        }
        return $this;
    }

    /**
     * @return string
     */
    final public function getNavbar(): string
    {
        $this->setListWrapper();

        $this->setListItems();

        return Render::arrayToString($this->getListWrapper());
    }

    /**
     * @return string
     */
    final public function getBreadcrumb(): string
    {
        return json_encode($this->breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}