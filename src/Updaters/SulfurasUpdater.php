<?php

namespace GildedRose\Updaters;

use GildedRose\Interfaces\UpdatersInterface;
use GildedRose\Item;

class SulfurasUpdater extends ItemUpdater implements UpdatersInterface
{
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function __toString(): string
    {
        return "{$this->item}";
    }

    public function update(): void
    {
        $this->item->quality = 80;
    }

    public static function resolve(Item $item): bool
    {
        return $item->name === 'Sulfuras, Hand of Ragnaros';
    }

    public static function getInstance(Item $item): self
    {
        return new self($item);
    }
}
