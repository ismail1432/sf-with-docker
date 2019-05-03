<?php


namespace App\Legacy\Normalizer;

// FQCN = App\Legacy\Normalizer\PostNormalizer;



use App\Legacy\Entity\Article;

class PostNormalizer extends AbstractNormalizer
{
    public function convertToLegacy(): \Iterator
    {
        yield 'id' => 'identifiant';
        yield 'title' => 'titre';
        yield 'content' => 'contenu';
        yield 'parutionDate' => 'dateDeParution';
    }

    public function getLegacyObject()
    {
        return new Article();
    }
}
