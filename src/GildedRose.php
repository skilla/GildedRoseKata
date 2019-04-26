<?php

namespace GildedRose;

class GildedRose {

    const MINIMUM_DECREASE_QUALITY = 1;
    const MINIMUM_INCREASE_QUALITY = 1;
    const MINIMUM_QUALITY = 0;
    const MAXIMUM_QUALITY = 50;
    const MINIMUM_SELL_IN = 0;
    const MINIMUM_DECREASE_SELL_IN = 1;
    const FIRST_BACKSTAGE_LIMIT = 6;
    const SECOND_BACKSTAGE_LIMIT = 11;
    const AGED_BRIE = "Aged Brie";
    const BACKSTAGE = "Backstage passes to a TAFKAL80ETC concert";
    const SULFURAS = "Sulfuras, Hand of Ragnaros";

    public static function updateQuality(
		$items
	) {
		for ($i = 0; $i < count($items); $i++) {
            $item = $items[$i];
            if ((self::AGED_BRIE != $item->getName()) && (self::BACKSTAGE != $item->getName())) {
				if ($item->getQuality() > self::MINIMUM_QUALITY) {
					if (self::SULFURAS != $item->getName()) {
						$item->setQuality($item->getQuality() - self::MINIMUM_DECREASE_QUALITY);
					}
				}
			} else {
				if ($item->getQuality() < self::MAXIMUM_QUALITY) {
					$item->setQuality($item->getQuality() + self::MINIMUM_INCREASE_QUALITY);
					if (self::BACKSTAGE == $item->getName()) {
						if ($item->getSellIn() < self::SECOND_BACKSTAGE_LIMIT) {
							if ($item->getQuality() < self::MAXIMUM_QUALITY) {
								$item->setQuality($item->getQuality() + self::MINIMUM_INCREASE_QUALITY);
							}
						}
						if ($item->getSellIn() < self::FIRST_BACKSTAGE_LIMIT) {
							if ($item->getQuality() < self::MAXIMUM_QUALITY) {
								$item->setQuality($item->getQuality() + self::MINIMUM_INCREASE_QUALITY);
							}
						}
					}
				}
			}

			if (self::SULFURAS != $item->getName()) {
				$item->setSellIn($item->getSellIn() - self::MINIMUM_DECREASE_SELL_IN);
			}

			if ($item->getSellIn() < self::MINIMUM_SELL_IN) {
				if (self::AGED_BRIE != $item->getName()) {
					if (self::BACKSTAGE != $item->getName()) {
						if ($item->getQuality() > self::MINIMUM_QUALITY) {
							if (self::SULFURAS != $item->getName()) {
								$item->setQuality($item->getQuality() - self::MINIMUM_DECREASE_QUALITY);
							}
						}
					} else {
						$item->setQuality($item->getQuality() - $item->getQuality());
					}
				} else {
					if ($item->getQuality() < self::MAXIMUM_QUALITY) {
						$item->setQuality($item->getQuality() + self::MINIMUM_INCREASE_QUALITY);
					}
				}
			}
		}
	}
}
