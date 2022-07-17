<?php

namespace GildedRose\Interfaces;

use GildedRose\Item;

interface FactoryInterface
{
    public function create(string $updater, Item $item): UpdatersInterface;
}
