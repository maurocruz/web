<?php

declare(strict_types=1);

namespace Plinct\Web\Element;

class Table
{
    /**
     * @var array|string[]
     */
    private array $table = ['tag'=>'table'];
    /**
     * @var array|string[]
     */
    private array $caption = ['tag'=>'caption'];
    /**
     * @var ?array
     */
    private ?array $head = null;
    /**
     * @var array|string[]
     */
    private array $body = ['tag'=>'tbody'];
    /**
     * @var array|null
     */
    private ?array $trBody = null;
    /**
     * @var ?array
     */
    private ?array $foot = null;
    /**
     * @var array|null
     */
    private ?array $attributes;

    /**
     * @param array|null $attributes
     */
    public function __construct(array $attributes = null)
    {
        $this->attributes = $attributes;
        $this->table['attributes'] = $attributes;
    }

    /**
     * @param string $caption
     * @return void
     */
    public function caption(string $caption)
    {
        $this->caption['content'] = $caption;
    }

    /**
     * @return void
     */
    private function setTrBody(): void
    {
        $this->trBody = ['tag'=>'tr'];
    }

    /**
     * HEADERS
     * @param null $attributes
     */
    private function setHead($attributes = null): void
    {
        if (!$this->head) {
            $this->head = [ "tag" => "thead", "attributes" => $attributes, "content" => [ [ "tag" => "tr" ] ] ];
        }
    }

    /**
     * @param string $content
     * @param array|null $attributes
     * @param string|null $href
     * @return $this
     */
    public function head(string $content, array $attributes = null, string $href = null): Table
    {
        $this->setHead();
        $href = is_numeric($href) ? null : $href;
        $this->head['content'][0]['content'][] = [ "tag" => "th", "content" => $content, "href" => $href, "attributes" => $attributes ] ;
        return $this;
    }

    /**
     * @param array $headers
     * @param $attributes
     * @return $this
     */
    public function headers(array $headers, $attributes = null): Table
    {
        $this->setHead($attributes);
        foreach ($headers as $href => $content) {
            $this->head($content, null, is_string($href) ? $href : null);
        }
        return $this;
    }

    /**
     * @param $content
     * @param $attributes
     * @param $href
     * @return $this
     */
    public function bodyCell($content, $attributes = null, $href = null): Table
    {
        if (!$this->trBody) $this->setTrBody();
        $this->trBody['content'][] = [ "tag" => "td", "content" => $content, "attributes" => $attributes, "href" => $href ];
        return $this;
    }

    /**
     * @return void
     */
    public final function closeRow()
    {
        $this->body['content'][] = $this->trBody;
        $this->trBody = null;
    }

    /**
     * @return void
     */
    private function setFoot(): void
    {
        if (!$this->foot) {
            $this->foot = [ "tag" => "tfoot", "content" => [ [ "tag" => "tr" ] ] ];
        }
    }

    /**
     * @param string|null $content
     * @param array|null $attributes
     * @param string|null $href
     * @return $this
     */
    public function foot(string $content = null, array $attributes = null, string $href = null): Table
    {
        $this->setFoot();
        $href = is_numeric($href) ? null : $href;
        $this->foot['content'][0]['content'][] = [ "tag" => "th", "content" => $content, "href" => $href, "attributes" => $attributes ] ;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfRows(): int
    {
        return isset($this->body['content']) ? count($this->body['content']) : 0;
    }

    /**
     * @return array|string[]
     */
    public final function ready(): array
    {
        if (isset($this->caption['content'])) $this->table['content'][] = $this->caption;
        if ($this->head) $this->table['content'][] = $this->head;
        if ($this->body) $this->table['content'][] = $this->body;
        if ($this->foot) $this->table['content'][] = $this->foot;
        return $this->table;
    }
}
