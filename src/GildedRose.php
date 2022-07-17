<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    private array $items = [];

    private DirectorFactories $director;

    public function __construct(array $items, DirectorFactories $directorFactories)
    {
        $this->items = $items;
        $this->director = $directorFactories;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->updateItem($item);
        }
    }

    public function updateItem(Item $item): void
    {
        $updaterToInstanciate = $this->director->itemClassifier->categorize($item);
        $instance = $this->director->updater->create($updaterToInstanciate, $item);

        $instance->update();
    }
}
