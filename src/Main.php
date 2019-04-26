<?php

namespace GildedRose;

use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackStage;
use GildedRose\Items\Conjured;
use GildedRose\Items\Dexterity;
use GildedRose\Items\Elixir;
use GildedRose\Items\NewItem;
use GildedRose\Items\Sulfuras;

require_once __DIR__ . "/../vendor/autoload.php";

$items = array();

$items []= new Dexterity(10, 20);
$items []= new AgedBrie(2, 0);
$items []= new Elixir(5, 7);
$items []= new Sulfuras(0, 80);
$items []= new BackStage(15, 20);
$items []= new Conjured(3, 6);

GildedRose::updateQuality($items);

foreach ($items as $item) {
    echo $item->__toString() . "\n";
}
