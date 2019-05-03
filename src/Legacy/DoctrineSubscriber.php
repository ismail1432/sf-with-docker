<?php


namespace App\Legacy;


use App\Entity\Post;
use App\Legacy\Manager\LegacyPostManager;
use App\Legacy\Normalizer\AbstractNormalizer;
use App\Legacy\Normalizer\FactoryNormalizer;
use App\Legacy\Normalizer\LegacyNormalizerInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class DoctrineSubscriber implements EventSubscriber
{
    private $legacyPostManager;
    private $factoryNormalizer;
    private $accessor;

    /**
     * DoctrineSubscriber constructor.
     * @param $legacyPostManager
     */
    public function __construct(LegacyPostManager $legacyPostManager, FactoryNormalizer $factoryNormalizer, PropertyAccessorInterface $accessor)
    {
        $this->legacyPostManager = $legacyPostManager;
        $this->factoryNormalizer = $factoryNormalizer;
        $this->accessor = $accessor;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        /** @var Post $post */
        $post = $args->getObject();

        if(!$post instanceof LegacyNormalizerInterface) {
            return;
        }

        /** @var AbstractNormalizer $normalizer */
        $normalizer = $this->factoryNormalizer->createNormalizer($post->getFQCNNormalizer(), $this->accessor);

        $article = $normalizer->normalize($post);

        $this->legacyPostManager->persistAndFlush($article);
    }
}
