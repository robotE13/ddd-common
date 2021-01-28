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
     * @param mixed $index An index to check for.
     * @return bool Returns true on success or false on failure.
     */
    public function exist($index):bool;

    public function put($item, bool $overwrite = true): void;

    public function get($index);

    public function remove($index);
}
