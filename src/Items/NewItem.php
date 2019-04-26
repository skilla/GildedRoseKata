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

    public function spendADay()
    {
        $item = $this->item;
        self::decreaseQualityIfHasQuality($item);

        self::decreaseSellIn($item);

        if (!self::isUnderMinimumSellIn($item)) {
            return;
        }

        self::decreaseQualityIfHasQuality($item);
    }

    final protected function increaseQualityIfNotMaximumQuality(Item $item)
    {
        if (!self::hasMaximumQuality($item)) {
            self::increaseQuality($item);
        }
    }

    /**
     * @param $item
     * @return bool
     */
    final protected function hasMaximumQuality(Item $item)
    {
        return $item->getQuality() >= self::MAXIMUM_QUALITY;
    }

    final protected function increaseQuality(Item $item)
    {
        $item->setQuality($item->getQuality() + self::MINIMUM_INCREASE_QUALITY);
    }

    final protected function decreaseSellIn(Item $item)
    {
        $item->setSellIn($item->getSellIn() - self::MINIMUM_DECREASE_SELL_IN);
    }

    /**
     * @param $item
     * @return bool
     */
    final protected function isUnderMinimumSellIn(Item $item)
    {
        return $item->getSellIn() < self::MINIMUM_SELL_IN;
    }

    final protected function setMinimumQuality(Item $item)
    {
        $item->setQuality($item->getQuality() - $item->getQuality());
    }

    final protected function decreaseQualityIfHasQuality(Item $item)
    {
        if ($this->hasQuality($item)) {
            $this->decreaseQuality($item);
        }
    }

    /**
     * @param $item
     * @return bool
     */
    final protected function hasQuality(Item $item)
    {
        return $item->getQuality() > self::MINIMUM_QUALITY;
    }

    final protected function decreaseQuality(Item $item)
    {
        $item->setQuality($item->getQuality() - self::MINIMUM_DECREASE_QUALITY);
    }
}
