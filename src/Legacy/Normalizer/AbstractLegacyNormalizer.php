<?php


namespace App\Legacy\Normalizer;


use App\Legacy\Entity\SynchronizeInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;

abstract class AbstractLegacyNormalizer
{
    private $propertyAccessor;

    public function __construct(PropertyAccessor $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * Transform default Object to Legacy Object
     */
    public function normalize(SynchronizeInterface $object)
    {
        $legacyObject = $this->getLegacyObject();

        foreach ($this->convertToLegacy() as $default => $legacy) {

            $value = $this->propertyAccessor->getValue($object, $default);
            $this->propertyAccessor->setValue($legacyObject, $legacy, $value);
        }

        return $legacyObject;
    }

    abstract public function convertToLegacy(): \Iterator;

    abstract public function getLegacyObject();
}
