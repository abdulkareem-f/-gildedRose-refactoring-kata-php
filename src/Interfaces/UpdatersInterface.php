<?php

namespace GildedRose\Interfaces;

use GildedRose\Item;

 interface UpdatersInterface
 {
     public static function resolve(Item $item): bool;

     public function update(): void;
 }
