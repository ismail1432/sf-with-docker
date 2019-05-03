<?php


namespace App\Legacy\Manager;


use Doctrine\ORM\EntityManagerInterface;

class LegacyPostManager
{
    private $legacyManager;

    /**
     * LegacyPostManager constructor.
     * @param $manager
     */
    public function __construct(EntityManagerInterface $legacyManager)
    {
        $this->legacyManager = $legacyManager;
    }


    public function persistAndFlush($object, $persist = true)
    {
        if($persist) {
            $this->legacyManager->persist($object);
        }

        $this->legacyManager->flush();
    }
}
