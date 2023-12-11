<?php

namespace App\Buscador;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    public function __construct(private ClientInterface $http, private Crawler $crawler)
    {
    }

    public function buscar(string $url): array
    {
        $response = $this->http->get($url);

        $html = $response->getBody();

        $this->crawler->addHtmlContent($html);

        $crawlerCursos = $this->crawler->filter('span.card-curso__nome');
        $cursos = [];

        foreach ($crawlerCursos as $crawler) {
            $cursos[] = $crawler->textContent;
        }

        return $cursos;
    }
}
