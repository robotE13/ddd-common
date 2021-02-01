<?php

/*
 * This file is part of the ddd-common.
 *
 * Copyright 2021 Evgenii Dudal <wolfstrace@gmail.com>.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * @package ddd-common
 */

namespace RobotE13\DDD\Entities\Collection;

/**
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
trait CollectionTrait
{

    private $items = [];

    public function exist($index): bool
    {
        return key_exists($index, $this->items);
    }

    /**
     *
     * @param mixed $key
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function get($key)
    {
        Assert::keyExists($this->items, $key, $this->getItemName() . " with key `{$key}` not present in collection");
        return clone $this->items[$key];
    }

    public function remove($key)
    {
        Assert::keyExists($this->items, $key, "Обект с ключом {$key} не найден.");
        unset($this->items[$key]);
    }

    public function toArray()
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): \Traversable
    {
        yield from $this->items;
    }

}
