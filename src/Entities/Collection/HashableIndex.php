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
     * Получение ключа для доступа к элементу коллекции.
     * Функция определяет способ получение хеш-ключа для внутренноего массива элементов коллекции.
     * @param type $item
     */
    public function resolveIndexOf($item);
}
