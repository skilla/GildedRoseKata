<?php

namespace GildedRose;

class GildedRose {

    const MINIMUM_DECREASE_QUALITY = 1;
    const MINIMUM_INCREASE_QUALITY = 1;
    const MINIMUM_QUALITY = 0;
    const MAXIMUM_QUALITY = 50;
    const MINIMUM_SELL_IN = 0;
    const MINIMUM_DECREASE_SELL_IN = 1;
    const FIRST_BACKSTAGE_LIMIT = 11;
    const SECOND_BACKSTAGE_LIMIT = 6;
    const AGED_BRIE = "Aged Brie";
    const BACKSTAGE = "Backstage passes to a TAFKAL80ETC concert";
    const SULFURAS = "Sulfuras, Hand of Ragnaros";

    public static function updateQuality(
		$items
	) {
		foreach ($items as $item) {
            if (self::isAgedBrie($item) || self::isBackStage($item)) {
				if (!self::hasMaximumQuality($item)) {
					self::increaseQuality($item);
					if (self::isBackStage($item)) {
						if (self::isBackStageInFirstDecreaseLimit($item)) {
							if (!self::hasMaximumQuality($item)) {
								self::increaseQuality($item);
							}
						}
						if (self::isBackStageInSecondDecreaseLimit($item)) {
							if (!self::hasMaximumQuality($item)) {
								self::increaseQuality($item);
							}
						}
					}
				}
			} else {
				if (self::hasQuality($item)) {
					if (!self::isSulfuras($item)) {
						self::decreaseQuality($item);
					}
				}
			}

			if (!self::isSulfuras($item)) {
				self::decreaseSellIn($item);
			}

			if (!self::isUnderMinimumSellIn($item)) {
                continue;
            }

            if (self::isAgedBrie($item)) {
                if (self::hasMaximumQuality($item)) {
                    continue;
                }
                self::increaseQuality($item);
                continue;
            }

            if (self::isBackStage($item)) {
                self::setMinimumQuality($item);
                continue;
            }

            if (self::hasQuality($item)) {
                if (!self::isSulfuras($item)) {
                    self::decreaseQuality($item);
                }
            }
		}
	}

    /**
     * @param $item
     * @return bool
     */
    private static function isAgedBrie($item)
    {
        return self::AGED_BRIE === $item->getName();
    }

    /**
     * @param $item
     * @return bool
     */
    private static function isBackStage($item)
    {
        return self::BACKSTAGE === $item->getName();
    }

    /**
     * @param $item
     * @return bool
     */
    private static function hasQuality($item)
    {
        return $item->getQuality() > self::MINIMUM_QUALITY;
    }

    /**
     * @param $item
     * @return bool
     */
    private static function isSulfuras($item)
    {
        return self::SULFURAS === $item->getName();
    }

    /**
     * @param $item
     * @return bool
     */
    private static function hasMaximumQuality($item)
    {
        return $item->getQuality() >= self::MAXIMUM_QUALITY;
    }

    /**
     * @param $item
     * @return bool
     */
    private static function isBackStageInFirstDecreaseLimit($item)
    {
        return $item->getSellIn() < self::FIRST_BACKSTAGE_LIMIT;
    }

    /**
     * @param $item
     * @return bool
     */
    private static function isBackStageInSecondDecreaseLimit($item)
    {
        return $item->getSellIn() < self::SECOND_BACKSTAGE_LIMIT;
    }

    /**
     * @param $item
     * @return bool
     */
    private static function isUnderMinimumSellIn($item)
    {
        return $item->getSellIn() < self::MINIMUM_SELL_IN;
    }

    /**
     * @param $item
     * @return mixed
     */
    private static function decreaseQuality($item)
    {
        return $item->setQuality($item->getQuality() - self::MINIMUM_DECREASE_QUALITY);
    }

    /**
     * @param $item
     * @return mixed
     */
    private static function increaseQuality($item)
    {
        return $item->setQuality($item->getQuality() + self::MINIMUM_INCREASE_QUALITY);
    }

    /**
     * @param $item
     * @return mixed
     */
    private static function decreaseSellIn($item)
    {
        return $item->setSellIn($item->getSellIn() - self::MINIMUM_DECREASE_SELL_IN);
    }

    /**
     * @param $item
     * @return mixed
     */
    private static function setMinimumQuality($item)
    {
        return $item->setQuality($item->getQuality() - $item->getQuality());
    }
}
