<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    const HEADER_DAY = 1;
    const HEADER_COLUMN_NAMES = 1;
    const SEPARATING_LINE_BREAK = 1;
    /**
     * @var Item[]
     */
    private $initialItems;

    public function setUp(): void
    {
        parent::setUp();

        $dexterityVest = new Item('+5 Dexterity Vest', 10, 20);
        $agedBrie = new Item('Aged Brie', 2, 0);
        $elixirOfTheMongoose = new Item('Elixir of the Mongoose', 5, 7);
        $sulfuras = new Item('Sulfuras, Hand of Ragnaros', 0, 80);
        $backstagePass1 = new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20);
        $backstagePass2 = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49);
        $backstagePass3 = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49);
        $conjuredManaCake = new Item('Conjured Mana Cake', 3, 6);

        $this->initialItems = [
            $dexterityVest,
            $agedBrie,
            $elixirOfTheMongoose,
            $sulfuras,
            $backstagePass1,
            $backstagePass2,
            $backstagePass3,
            $conjuredManaCake
        ];
    }

    public function testFoo(): void
    {
        $file = file_get_contents('/usr/src/gilded-rose-php/tests/approvals/ApprovalTest.testTestFixture.approved.txt');
        $fileByLines = explode(PHP_EOL, $file);

        $gildedRose = new GildedRose($this->initialItems);
        $lengthOfBlock = count($this->initialItems) + self::HEADER_DAY + self::HEADER_COLUMN_NAMES + self::SEPARATING_LINE_BREAK;

        for ($i = 0; $i < 30; $i++) {
            $this->assertSame("-------- day {$i} --------", $fileByLines[$lengthOfBlock * $i]);
            $this->assertSame("name, sellIn, quality", $fileByLines[$lengthOfBlock * $i + 1]);

            $itemsToday = $gildedRose->items();
            for ($j = 0; $j < count($itemsToday); $j++) {
                $this->assertSame("{$itemsToday[$j]->name}, {$itemsToday[$j]->sell_in}, {$itemsToday[$j]->quality}", $fileByLines[$lengthOfBlock * $i + 2 + $j]);
            }

            $gildedRose->updateQuality();
        }
    }
}
