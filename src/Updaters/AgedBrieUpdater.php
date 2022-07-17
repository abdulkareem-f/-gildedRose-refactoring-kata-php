<?php

namespace GildedRose\Updaters;

use GildedRose\Item;

class AgedBrieUpdater extends ItemUpdater
{

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function __toString(): string
    {
        return "{$this->item}";
    }

    public function updateSellIn(): void
    {
        --$this->item->sell_in;
    }

    public function updateQuality(): void
    {
        $this->increaseQuality();
    }

    public function update(): void
    {
        $this->updateSellIn();
        $this->updateQuality();
    }

    public static function resolve(Item $item): bool
    {
        return $item->name === 'Aged Brie';
    }

    protected function increaseQuality(): void
    {
        if ($this->item->quality < 50) {
            if ($this->updateExpired()) {
                ++$this->item->quality;
            } else {
                $this->item->quality += 2;
            }
        } else {
            $this->item->quality = 50;
        }
    }

    protected function updateExpired(): bool
    {
        if ($this->item->sell_in < 0) {
            return false;
        }
        return true;
    }
}
