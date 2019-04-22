<?php


namespace App\Legacy\Entity;


interface SynchronizeInterface
{
    public function convertToLegacy(): \Iterator;
}
