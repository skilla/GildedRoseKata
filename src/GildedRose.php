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
			if ((self::AGED_BRIE != $items[$i]->getName()) && (self::BACKSTAGE != $items[$i]->getName())) {
				if ($items[$i]->getQuality() > self::MINIMUM_QUALITY) {
					if (self::SULFURAS != $items[$i]->getName()) {
						$items[$i]->setQuality($items[$i]->getQuality() - self::MINIMUM_DECREASE_QUALITY);
					}
				}
			} else {
				if ($items[$i]->getQuality() < self::MAXIMUM_QUALITY) {
					$items[$i]->setQuality($items[$i]->getQuality() + self::MINIMUM_INCREASE_QUALITY);
					if (self::BACKSTAGE == $items[$i]->getName()) {
						if ($items[$i]->getSellIn() < self::SECOND_BACKSTAGE_LIMIT) {
							if ($items[$i]->getQuality() < self::MAXIMUM_QUALITY) {
								$items[$i]->setQuality($items[$i]->getQuality() + self::MINIMUM_INCREASE_QUALITY);
							}
						}
						if ($items[$i]->getSellIn() < self::FIRST_BACKSTAGE_LIMIT) {
							if ($items[$i]->getQuality() < self::MAXIMUM_QUALITY) {
								$items[$i]->setQuality($items[$i]->getQuality() + self::MINIMUM_INCREASE_QUALITY);
							}
						}
					}
				}
			}

			if (self::SULFURAS != $items[$i]->getName()) {
				$items[$i]->setSellIn($items[$i]->getSellIn() - self::MINIMUM_DECREASE_SELL_IN);
			}

			if ($items[$i]->getSellIn() < self::MINIMUM_SELL_IN) {
				if (self::AGED_BRIE != $items[$i]->getName()) {
					if (self::BACKSTAGE != $items[$i]->getName()) {
						if ($items[$i]->getQuality() > self::MINIMUM_QUALITY) {
							if (self::SULFURAS != $items[$i]->getName()) {
								$items[$i]->setQuality($items[$i]->getQuality() - self::MINIMUM_DECREASE_QUALITY);
							}
						}
					} else {
						$items[$i]->setQuality($items[$i]->getQuality() - $items[$i]->getQuality());
					}
				} else {
					if ($items[$i]->getQuality() < self::MAXIMUM_QUALITY) {
						$items[$i]->setQuality($items[$i]->getQuality() + self::MINIMUM_INCREASE_QUALITY);
					}
				}
			}
		}
	}
}
