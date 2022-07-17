<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\DirectorFactories;
use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\ItemClassifier;
use GildedRose\UpdatersFactory;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $directorFactories = new DirectorFactories(new UpdatersFactory(), new ItemClassifier());
        $gildedRose = new GildedRose($items, $directorFactories);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }
}
