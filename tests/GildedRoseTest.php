<?php

namespace GildedRose\Tests;

use GildedRose\GildedRose;
use GildedRose\Items\AgedBrie;
use GildedRose\Items\BackStage;
use GildedRose\Items\Conjured;
use GildedRose\Items\Dexterity;
use GildedRose\Items\Elixir;
use GildedRose\Items\Sulfuras;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function test_items_degradan_calidad()
    {
        $items[0] = new Conjured(10, 5);
        GildedRose::updateQuality($items);
        $this->assertEquals(4, $items[0]->quality());
    }

    public function test_venta_pasada_calidad_degrada_doble()
    {
        $items[0] = new Elixir(-1, 5);
        GildedRose::updateQuality($items);
        $this->assertEquals(3, $items[0]->quality());
    }

    public function test_calidad_nunca_negativa()
    {
        $items[0] = new Dexterity(10, 0);
        GildedRose::updateQuality($items);
        $this->assertEquals(0, $items[0]->quality());
    }

    public function test_aged_brie_incrementa_calidad()
    {
        $items[0] = new AgedBrie(10, 5);
        GildedRose::updateQuality($items);
        $this->assertEquals(6, $items[0]->quality());
    }

    public function test_calidad_nunca_mayor_de_50()
    {
        $items[0] = new AgedBrie(10, 50);
        GildedRose::updateQuality($items);
        $this->assertEquals(50, $items[0]->quality());
    }

    public function test_sulfuras_no_cambia()
    {
        $items[0] = new Sulfuras(10, 10);
        GildedRose::updateQuality($items);
        $this->assertEquals(10, $items[0]->sellIn());
        $this->assertEquals(10, $items[0]->quality());
    }

    public static function backstage_rules()
    {
        return array(
            "incr. 1 si sellIn > 10"            => array(11, 10, 11),
            "incr. 2 si 5 < sellIn <= 10 (max)" => array(10, 10, 12),
            "incr. 2 si 5 < sellIn <= 10 (min)" => array(6,  10, 12),
            "incr. 3 si 0 < sellIn <= 5 (max)"  => array(5,  10, 13),
            "incr. 3 si 0 < sellIn <= 5 (min)"  => array(1,  10, 13),
            "se pone a 0 si sellIn <= 0 (max)"  => array(0,  10, 0),
            "se pone a 0 si sellIn <= 0 (...)"  => array(-1, 10, 0)
        );
    }

    /**
     * @dataProvider backstage_rules
     */
    public function test_backstage_passes_incrementan_calidad_cada_vez_mas(
        $sellIn,
        $quality,
        $expected
    ) {
        $items[0] = new BackStage($sellIn, $quality);
        GildedRose::updateQuality($items);
        $this->assertEquals($expected, $items[0]->quality());
    }
}
