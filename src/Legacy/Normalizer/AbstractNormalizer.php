<?php


namespace App\Legacy\Normalizer;


use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

abstract class AbstractNormalizer
{
    private $propertyAccessor;

    public function __construct(PropertyAccessorInterface $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    public function normalize($object)
    {
        $legacyObject = $this->getLegacyObject();

        foreach ($this->convertToLegacy() as $default => $legacy) {

            $value = $this->propertyAccessor->getValue($object, $default);

            $this->propertyAccessor->setValue($legacyObject, $legacy, $value);
        }

        return $legacyObject;
    }

    public abstract function convertToLegacy(): \Iterator;

    public abstract function getLegacyObject();
}
