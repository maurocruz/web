<?php
namespace Plinct\Web\Resource;

use Plinct\Web\Interfaces\ResourceInterface;

class Resource implements ResourceInterface {
    private $https;
    private $host;
    private $documentRoot;
    private $queryString;
    private $requestUri;

    public function __construct() {
        $this->https = $_SERVER['HTTPS'] ?? null;
        $this->host = $_SERVER['HTTP_HOST'];
        $this->documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $this->queryString = $_SERVER['QUERY_STRING'];
        $this->requestUri = $_SERVER['REQUEST_URI'];
    }

    public function uri(): ResourceInterface {
        return $this;
    }

    public final function getHost(): string {
        return $this->host;
    }

    public function getParams(): array {
        return explode('/',$this->requestUri);
    }

    public function getParam(int $level): string {
        return $this->getParams()[$level];
    }
}