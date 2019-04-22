<?php


namespace App\Legacy\Listener;


use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;

class LegacyOperationSubscriber implements EventSubscriber
{
    private $legacyManager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->legacyManager = $manager->getConnection('legacy');
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {

    }

    private function synchronize(LifecycleEventArgs $args, $operation)
    {

    }
}
