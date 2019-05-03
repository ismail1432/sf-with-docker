<?php


namespace App\Legacy\Listener;


use App\Legacy\Normalizer\AbstractLegacyNormalizer;
use App\Legacy\Normalizer\NormalizerFactory;
use App\Legacy\Entity\SynchronizeInterface;
use App\Legacy\LegacyPostManager;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class LegacyOperationSubscriber implements EventSubscriber
{
    private $legacyManager;
    private $factory;
    private $propertyAccessor;

    public function __construct(LegacyPostManager $manager, PropertyAccessorInterface $propertyAccessor, NormalizerFactory $factory)
    {
        $this->legacyManager = $manager;
        $this->factory = $factory;
        $this->propertyAccessor = $propertyAccessor;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        /** @var SynchronizeInterface $object */
        $object = $args->getObject();

        /** @var AbstractLegacyNormalizer $normalizer */
        $normalizer = $this->factory::createNormalizer($this->propertyAccessor, $object->getFQCNNormalizer());

        $legacyObject = $normalizer->normalize($object);

        $this->legacyManager->persistAndFlush($legacyObject, true);
    }
}
