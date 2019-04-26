<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;

abstract class NewItem
{
    const NAME = "empty name";

    /** @var Item $item */
    protected $item;

    final public function __construct(int $sellIn, int $quality)
    {
        $this->item = new Item(static::NAME, $sellIn, $quality);
    }

    final public function item(): Item
    {
        return clone($this->item);
    }

    final public function __toString()
    {
        return "Item: {$this->item->name}, Quality: {$this->item->quality}, SellIn: {$this->item->sellIn}";
    }

    final public function name(): string
    {
        return $this->item->getName();
    }

    final public function sellIn(): int
    {
        return $this->item->getSellIn();
    }

    final public function quality(): int
    {
        return $this->item->getQuality();
    }

    public abstract function spendADay();
}
