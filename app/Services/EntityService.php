<?php

namespace App\Services;

use Illuminate\Support\Facades\Process;
use Spatie\Browsershot\Browsershot;

class EntityService
{
    private string $scriptPath;
    public function __construct() {
        $this->scriptPath = base_path().'/scripts';
    }

    public function SearchEntities(string $url, string $keyWord = '')
    {
        $html = $this->getHtml($url);
        $plainTextBody = $this->extractPlainTextBody($html);
        file_put_contents($this->scriptPath.'/plainText.txt', $plainTextBody);

        $this->getGoogleEntities($keyWord);

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
        $dom = new \DOMDocument;
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
            $bodyContent = preg_replace(['/<\/?body[^>]*>/', '/[\n\t\r\x{A0}]+/u'],
                ['', ' '],
                $body);
        }

        return strip_tags($bodyContent);
    }

    private function getGoogleEntities(string $keyWord)
    {
        $filePath = $this->scriptPath.'/GoogleEntities.py';
        $result = Process::run("python3 $filePath agua");
        dd($result->output());
    }
}
