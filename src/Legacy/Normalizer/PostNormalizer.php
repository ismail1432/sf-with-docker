<?php


namespace App\Legacy\Normalizer;


use App\Legacy\Normalizer\AbstractLegacyNormalizer;
use App\Legacy\Entity\Article;

class PostNormalizer extends AbstractLegacyNormalizer
{
    public function convertToLegacy(): \Iterator
    {
        yield 'id' => 'identifiant';
        yield 'title' => 'titre';
        yield 'content' => 'contenu';
        yield 'parutionDate' => 'date_de_parution';
    }

    public function getLegacyObject()
    {
        return new Article();
    }
}
