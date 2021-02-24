<?php

/**
 * This file is part of the ddd-common.
 *
 * Copyright 2021 Evgenii Dudal <wolfstrace@gmail.com>.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * @package ddd-common
 */

namespace RobotE13\DDD\Entities\Collection;

use Webmozart\Assert\Assert;

/**
 * Description of AbsractHashableCollection
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
abstract class AbsractHashableCollection implements Collection, HashableIndex
{
    use CollectionTrait;

    const COLLECTION_ITEM_NAME = 'Item';

    public function __construct(array $items = [])
    {
        foreach ($items as $item)
        {
            $this->add($item);
        }
    }

    public function add($item): void
    {
        $index = $this->resolveIndexOf($item);
        Assert::keyNotExists($this->items, $index);
        $this->items[$index] = $item;
        return;
    }

}
