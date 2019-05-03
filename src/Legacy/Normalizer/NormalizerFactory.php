<?php


namespace App\Legacy\Normalizer;


use App\Legacy\Normalizer\AbstractLegacyNormalizer;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class NormalizerFactory
{
    public static function createNormalizer(PropertyAccessorInterface $propertyAccessor, string $class): AbstractLegacyNormalizer
    {
        return new $class($propertyAccessor);
    }
}
