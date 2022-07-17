<?php

namespace GildedRose\Updaters;

use GildedRose\Item;

class ConjuredItemUpdater extends ItemUpdater
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
        $this->decreaseQuality();
    }

    public function update(): void
    {
        $this->updateSellIn();
        $this->updateQuality();
    }

    public static function resolve(Item $item): bool
    {
        return $item->name === 'Conjured Mana Cake';
    }

    protected function decreaseQuality(): void
    {
        if ($this->updateExpired()) {
            --$this->item->quality;
            $this->checkQuality();
        } else {
            $this->item->quality -= 2;
            $this->checkQuality();
        }
    }

    protected function increaseQuality(): void
    {
        if ($this->item->quality < 50) {
            ++$this->item->quality;
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

    protected function checkQuality(): void
    {
        if ($this->item->quality <= 0) {
            $this->item->quality = 0;
        }
    }
}
