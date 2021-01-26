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

namespace RobotE13\DDD\Entities\Status;

/**
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
interface PossibleStates
{

    /**
     * Checks that numerical state value is valid.
     * @param int $state numerical representation of state
     * @return void
     * @throws \InvalidArgumentException
     */
    public function checkValidity(int $state): void;

    /**
     * Returns all of possible entity states.
     * The implementation should return a list of all possible states in an array of key-value pairs,
     * where `key` is numeric value of entity state and `value` text interpretation of a numeric value.
     * @return array
     */
    public function getAllExisting(): array;
}
