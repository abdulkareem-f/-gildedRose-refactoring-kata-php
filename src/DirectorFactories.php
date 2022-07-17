<?php

namespace GildedRose;

use GildedRose\Interfaces\ClassifiersInterface;
use GildedRose\Interfaces\FactoryInterface;

class DirectorFactories
{
    public FactoryInterface $updater;

    public ClassifiersInterface $itemClassifier;

    public function __construct(FactoryInterface $updater, ClassifiersInterface $itemClassifier)
    {
        $this->updater = $updater;
        $this->itemClassifier = $itemClassifier;
    }
}
