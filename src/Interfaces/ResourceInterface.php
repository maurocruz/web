<?php
namespace Plinct\Web\Interfaces;

interface ResourceInterface {

    public function getHost(): string;

    public function getParams(): array;

    public function getParam(int $level): string;
}