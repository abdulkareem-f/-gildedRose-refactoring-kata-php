<?php

namespace GildedRose\Interfaces;

use GildedRose\Item;

interface ClassifiersInterface
{
    public function getNameSpace(): array;

    public function categorize(Item $item): string;
}
