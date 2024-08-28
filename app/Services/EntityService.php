<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Spatie\Browsershot\Browsershot;
class EntityService
{
    public function __construct() {}

    public function SearchEntities(string $url)
    {
        $html = $this->getHtml($url);
        $plainTextBody = $this->extractPlainTextBody($html);

        return $plainTextBody;
    }

    private function getHtml(string $url): string
    {
        return Browsershot::url('https://www.santanderconsumer.es/prestamos/prestamos-de-ocasion.html')
            ->setOption('args', ['--no-sandbox'])
            ->waitUntilNetworkIdle()
            ->bodyHtml();
    }

    private function getBody(string $html): string
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $body = $dom->getElementsByTagName('body')->item(0);

        return $dom->saveHTML($body);
    }

    private function extractPlainTextBody(string $html): string
    {
        $bodyContent = '';
        $body = $this->getBody($html);

        if ($body) {
            $bodyContent = preg_replace( ['/<\/?body[^>]*>/', '/[\n\t\r\x{A0}]+/u'],
                ['', ' '],
                $body);
        }

        return strip_tags($bodyContent);
    }
}
