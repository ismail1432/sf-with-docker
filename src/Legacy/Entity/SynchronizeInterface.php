<?php


namespace App\Legacy\Entity;



use App\Legacy\Normalizer\AbstractLegacyNormalizer;

interface SynchronizeInterface
{
    public function getFQCNNormalizer(): string ;
}
