<?php


namespace App\Legacy\Normalizer;


use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class FactoryNormalizer
{
    /**
     * $class is the Normalizer FQCN
     */
    public function createNormalizer($class, PropertyAccessorInterface $propertyAccessor)
    {
        return new $class($propertyAccessor);
    }
}
