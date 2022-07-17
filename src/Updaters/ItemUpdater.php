<?php

namespace GildedRose\Updaters;

use GildedRose\Interfaces\UpdatersInterface;
use GildedRose\Item;

class ItemUpdater implements UpdatersInterface
{
    protected Item $item;

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
        return in_array($item->name, ['Elixir of the Mongoose', '+5 Dexterity Vest', 'foo'], true);
    }

    protected function decreaseQuality(): void
    {
        if ($this->item->sell_in >= 0) {
            --$this->item->quality;
            $this->checkQuality();
        } else {
            $this->item->quality -= 2;
            $this->checkQuality();
        }
    }

    protected function increaseQuality(): void
    {
        if ($this->updateExpired()) {
            ++$this->item->quality;
        } else {
            $this->item->quality = 0;
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
