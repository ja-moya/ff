<?php

declare(strict_types=1);

namespace App\CatalogContext\ScraperModule\Domain\Service;

use DOMDocument;
use Spatie\Browsershot\Browsershot;

class BrowserShotPageLoaderService
{
    public function __invoke(string $pageUrl, array $cookies = []): DOMDocument
    {
        $htmlContent = Browsershot::url($pageUrl)
            ->windowSize(400, 1200)
            ->setIncludePath('$PATH:/usr/local/bin')
            ->setNodeBinary('/usr/bin/node')
            ->setNpmBinary('/usr/bin/npm')
            ->setChromePath('/usr/bin/google-chrome-stable')
            ->setOption('cookies', $cookies)
            ->setOption('args', ['--no-sandbox', '--disable-setuid-sandbox'])
            ->setOption('userAgent',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36')
            //->setOption('slowMo', 50) // Ralentiza las acciones
            ->setOption('timeout', 60000)
            ->bodyHtml();

        $domDocument = new DOMDocument();
        @$domDocument->loadHTML('<?xml encoding="UTF-8">' . $htmlContent);

        return $domDocument;
    }
}
