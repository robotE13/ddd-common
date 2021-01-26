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

use Webmozart\Assert\Assert;

/**
 * Реализует общие методы интерфейса {{@see PossibleState}}
 * @see PossibleStates
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
abstract class AbstractState implements PossibleStates, RepresentableAsText
{

    private $state;

    public function __construct(int $state)
    {
        $this->setState($state);
    }

    /**
     * Implements a method from the PossibleState interface.
     * @see PossibleState::isValidValue($state)
     */
    final public function checkValidity(int $state): void
    {
        Assert::keyExists($this->getAllExisting(), $state);
    }

    /**
     * @see PossibleState::getAllExisting()
     */
    abstract public function getAllExisting(): array;

    /**
     * Implements a method from the PossibleState interface.
     * @see PossibleState::isValidValue()
     */
    final public function getTextValue(): string
    {
        return $this->getAllExisting()[$this->state];
    }

    /**
     * Returns the state value in a numeric form.
     * @return int
     */
    public function getState():int
    {
        return $this->state;
    }

    final protected function setState(int $state)
    {
        $this->checkValidity($state);
        $this->state = $state;
    }

}
