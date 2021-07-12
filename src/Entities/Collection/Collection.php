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
interface Collection extends \IteratorAggregate, \Countable
{

    /**
     * Whether an element exists.
     * @param mixed $index to check for.
     * @return bool Returns true on success or false on failure.
     */
    public function exist($index): bool;

    public function add($item): void;

    /**
     *
     * @param mixed $index to get collection item.
     * @return mixed collection item
     */
    public function get($index);

    /**
     *
     * @param mixed $index of the collection item being deleted
     */
    public function remove($index): void;

    public function toArray();

    /**
     * Получение типа элемента коллекции.
     * Должна возвращать полное имя класса для типизированной коллекции.
     * @return string имя класса объектов включаемых в коллекцию.
     */
    public function getItemClass(): string;

    /**
     * Получение названия элемента коллекции.
     * Должна возвращать человекопонятное название элемента коллекции для текстовых сообщений.
     * Например: "Контакт", "Тэг", "Комментарий" и т.п.
     * @return string название элемента коллекции.
     */
    public static function getItemName(): string;
}
