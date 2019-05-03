<?php


namespace App\Legacy;


use Doctrine\ORM\EntityManagerInterface;

class LegacyPostManager
{
    private $legacyManager;

    public function __construct(EntityManagerInterface $legacyManager)
    {
        $this->legacyManager = $legacyManager;
    }

    public function persistAndFlush($object, $flush = false)
    {
        $this->legacyManager->persist($object);

        if($flush) {
            $this->legacyManager->flush();
        }
    }
}
