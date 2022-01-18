<?php

declare(strict_types=1);

namespace Shop;

final class Shop
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        $magic_items = ['Magic item 1', 'Magic item 2', 'Magic item 3'];
        foreach ($this->items as $item) {
            if ($item->name != 'Mjolnir') {
                if ($item->name != 'Blue cheese' && $item->name != 'Concert tickets') {
                    if ($item->quality > 0) {
                        $item->quality -= 1;
                        if (in_array($item->name, $magic_items) && $item->quality > 0) {
                            $item->quality -= 1;
                        }
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality += 1;
                        if ($item->name == 'Concert tickets') {
                            if ($item->sell_in < 11 && $item->quality < 50) {
                                $item->quality += 1;
                            }
                            if ($item->sell_in < 6 && $item->quality < 50) {
                                $item->quality += 1;
                            }
                        }
                    }
                }

                $item->sell_in -= 1;
                if ($item->sell_in < 0) {
                    if ($item->name != 'Blue cheese') {
                        if ($item->name != 'Concert tickets') {
                            if ($item->quality > 0) {
                                $item->quality -= 1;
                            }
                        } else {
                            $item->quality = 0;
                        }
                    } else {
                        if ($item->quality < 50) {
                            $item->quality += 1;
                        }
                    }
                }
            }
        }
    }
}
