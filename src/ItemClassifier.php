<?php

namespace GildedRose;

use GildedRose\Interfaces\ClassifiersInterface;

class ItemClassifier implements ClassifiersInterface
{
    public function getNameSpace(): array
    {
        $fileList = glob('src/Updaters/*.php');
        $classListArray = [];
        foreach ($fileList as $filename) {
            if (is_file($filename)) {
                $class = explode('/', $filename);
                $class2 = explode('.', $class[2]);
                $classList = $class2[0];
                array_push($classListArray, '\\GildedRose\\Updaters\\' . $classList);
            }
        }
        return $classListArray;
    }

    public function categorize(Item $item): string
    {
        $updaters = $this->getNameSpace();
        foreach ($updaters as $updater) {
            if ($updater::resolve($item)) {
                return $updater;
            }
        }
		return '';
    }
}
