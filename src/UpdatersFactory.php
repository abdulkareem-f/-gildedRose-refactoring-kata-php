<?php

namespace GildedRose;

use GildedRose\Interfaces\FactoryInterface;
use GildedRose\Interfaces\UpdatersInterface;

class UpdatersFactory implements FactoryInterface
{
    public function create($updater, Item $item): UpdatersInterface
    {
        return new $updater($item);
    }
}
