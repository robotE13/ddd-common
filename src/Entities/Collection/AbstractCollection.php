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
 * Базовый класс для реализации типизированных коллекций
 *
 * Индексами коллекции будут являться порядковые номера добавленных элементов.
 * @method bool exist($index) {@see Collection::exist($index)}
 * @method mixed get($index) {@see Collection::get($index)}
 * @method void remove($index) {@see Collection::remove($index)}
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
abstract class AbstractCollection implements Collection
{

    use CollectionTrait;

    public function __construct(array $items = [])
    {
        Assert::allIsInstanceOf($items, $this->getItemClass());
        $this->items = $items;
    }

    /**
     *
     * @param mixed $item
     * @param bool $overwrite
     * @return void
     */
    public function add($item): void
    {
        Assert::isInstanceOf($item, $this->getItemClass());
        if (in_array($item, $this->items))
        {
            throw new \Webmozart\Assert\InvalidArgumentException($this->getItemName() . ' already exist.');
        }
        $this->items[] = $item;
    }

}
