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
interface HashableIndex
{
    /**
     * Вычисляет ключ для переданного объекта - элемента коллекции
     *
     * Функция определяет способ получение хеш-ключа из объекта.
     * Например:
     * <code>
     *      public function resolveIndexOf($item)
     *      {
     *          return hash('crc32', $item->getAttributeOne() . $item->getAttributeTwo());
     *      }
     * </code>
     * @param mixed $item
     * @return string hash-code
     */
    public function resolveIndexOf($item):string;
}
