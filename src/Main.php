<?php

namespace GildedRose;

use GildedRose\Items\NewItem;
use GildedRose\Items\Sulfuras;

require_once __DIR__ . "/../vendor/autoload.php";

$items = array();

$items []= new Item("+5 Dexterity Vest", 10, 20);
$items []= new Item("Aged Brie", 2, 0);
$items []= new Item("Elixir of the Mongoose", 5, 7);
$items []= new Sulfuras(0, 80);
$items []= new Item("Backstage passes to a TAFKAL80ETC concert", 15, 20);
$items []= new Item("Conjured Mana Cake", 3, 6);

GildedRose::updateQuality($items);

foreach ($items as $item) {
    if ($item instanceof NewItem) {
        echo $item->__toString() . "\n";
    } else {
        echo "Item: {$item->name}, Quality: {$item->quality}, SellIn: {$item->sellIn}\n";
    }
}
