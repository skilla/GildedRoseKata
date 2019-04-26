<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;

abstract class NewItem
{
    const MINIMUM_DECREASE_QUALITY = 1;
    const MINIMUM_INCREASE_QUALITY = 1;
    const MINIMUM_QUALITY = 0;
    const MAXIMUM_QUALITY = 50;
    const MINIMUM_SELL_IN = 0;
    const MINIMUM_DECREASE_SELL_IN = 1;
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

    final public function __toString(): string
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

    public function spendADay(): void
    {
        $item = $this->item;
        self::decreaseQualityIfHasQuality($item);

        self::decreaseSellIn($item);

        if (!self::isUnderMinimumSellIn($item)) {
            return;
        }

        self::decreaseQualityIfHasQuality($item);
    }

    final protected function increaseQualityIfNotMaximumQuality(Item $item): void
    {
        if (self::hasMaximumQuality($item)) {
            return;
        }
        self::increaseQuality($item);
    }

    final protected function hasMaximumQuality(Item $item): bool
    {
        return $item->getQuality() >= self::MAXIMUM_QUALITY;
    }

    final protected function increaseQuality(Item $item): void
    {
        $item->setQuality($item->getQuality() + self::MINIMUM_INCREASE_QUALITY);
    }

    final protected function decreaseSellIn(Item $item): void
    {
        $item->setSellIn($item->getSellIn() - self::MINIMUM_DECREASE_SELL_IN);
    }

    final protected function isUnderMinimumSellIn(Item $item): bool
    {
        return $item->getSellIn() < self::MINIMUM_SELL_IN;
    }

    final protected function setMinimumQuality(Item $item): void
    {
        $item->setQuality(self::MINIMUM_SELL_IN);
    }

    final protected function decreaseQualityIfHasQuality(Item $item): void
    {
        if ($this->hasQuality($item)) {
            $this->decreaseQuality($item);
        }
    }

    final protected function hasQuality(Item $item): bool
    {
        return $item->getQuality() > self::MINIMUM_QUALITY;
    }

    final protected function decreaseQuality(Item $item): void
    {
        $item->setQuality($item->getQuality() - self::MINIMUM_DECREASE_QUALITY);
    }
}
