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
 * AbstractCollection.
 * Базовый класс коллекций
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
abstract class AbstractCollection implements Collection
{

    const COLLECTION_ITEM_NAME = 'Item';

    private $items = [];

    public function __construct(array $items = [])
    {
        Assert::allIsInstanceOf($items, $this->getItemClass());
        $this->items = $items;
    }

    public function exist($index): bool
    {
        return key_exists($this->resolveIndex($index), $this->items);
    }

    /**
     *
     * @param mixed $index
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function get($index)
    {
        $key = $this->resolveIndex($index);
        Assert::keyExists($this->items, $key, $this->getItemName() . "с индексом {$key} не существует в коллекции.");
        return $this->items[$key];
    }

    /**
     *
     * @param mixed $item
     * @param bool $overwrite
     * @return void
     */
    public function put($item, bool $overwrite = true): void
    {
        $key = $this->resolveIndex($item);
        if(!$overwrite)
        {
            Assert::keyNotExists($this->items, $key, 'Данный ' . $this->getItemName() . 'уже существует.');
        }
        $this->items[$key] = $item;
    }

    public function remove($index)
    {
        $key = $this->resolveIndex($index);
        Assert::keyExists($this->items, $key, "Обект с ключом {$key} не найден.");
        unset($this->items[$key]);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): \Traversable
    {
        yield from $this->items;
    }

    private function resolveIndex($index)
    {
        return is_scalar($index) ? $index : $this->indexOf($index);
    }

    final public function getItemName()
    {
        return static::COLLECTION_ITEM_NAME;
    }

    abstract protected function indexOf($item = null);

    abstract protected function getItemClass();
}
