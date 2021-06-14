<?php
namespace Plinct\Web\Element;

class Table {
    private $table = [ "tag" => "table" ];
    private $caption = [ "tag" => "caption" ];
    private $head;
    private $body = [ "tag" => "tbody" ];
    private $trBody;
    private $foot;
    private $attributes;

    public function __construct($attributes = null) {
        $this->attributes = $attributes;
        $this->table['attributes'] = $attributes;
    }

    public function caption(string $caption) {
        $this->caption['content'] = $caption;
    }

    private function setTrBody(): void {
        $this->trBody = [ "tag" => "tr" ];
    }

    /**
     * HEADERS
     * @param null $attributes
     */
    private function setHead($attributes = null): void {
        if (!$this->head) {
            $this->head = [ "tag" => "thead", "attributes" => $attributes, "content" => [ [ "tag" => "tr" ] ] ];
        }
    }
    public function head(string $content, array $attributes = null, string $href = null): Table {
        $this->setHead();
        $href = is_numeric($href) ? null : $href;
        $this->head['content'][0]['content'][] = [ "tag" => "th", "content" => $content, "href" => $href, "attributes" => $attributes ] ;
        return $this;
    }
    public function headers(array $headers, $attributes = null): Table {
        $this->setHead($attributes);
        foreach ($headers as $href => $content) {
            $this->head($content, null, $href);
        }
        return $this;
    }

    /**
     * BODY
     */
    public function bodyCell($content, $attributes = null, $href = null): Table {
        if (!$this->trBody) $this->setTrBody();
        $this->trBody['content'][] = [ "tag" => "td", "content" => $content, "attributes" => $attributes, "href" => $href ];
        return $this;
    }

    public final function closeRow() {
        $this->body['content'][] = $this->trBody;
        $this->trBody = null;
    }

    private function setFoot(): void {
        if (!$this->foot) {
            $this->foot = [ "tag" => "tfoot", "content" => [ [ "tag" => "tr" ] ] ];
        }
    }
    public function foot(string $content = null, array $attributes = null, string $href = null): Table {
        $this->setFoot();
        $href = is_numeric($href) ? null : $href;
        $this->foot['content'][0]['content'][] = [ "tag" => "th", "content" => $content, "href" => $href, "attributes" => $attributes ] ;
        return $this;
    }

    public final function ready(): array {
        if (isset($this->caption['content'])) $this->table['content'][] = $this->caption;
        if ($this->head) $this->table['content'][] = $this->head;
        if ($this->body) $this->table['content'][] = $this->body;
        if ($this->foot) $this->table['content'][] = $this->foot;
        return $this->table;
    }
}