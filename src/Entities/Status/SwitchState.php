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

namespace RobotE13\DDD\Entities\Status;

/**
 * Description of SwitchState
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
final class SwitchState extends AbstractState
{

    const ENABLED = 1;
    const DISABLED = 0;

    public function enable()
    {
        $this->setState(static::ENABLED);
    }

    public function disable()
    {
        $this->setState(static::DISABLED);
    }

    public function isEnabled()
    {
        return $this->getState() === static::ENABLED;
    }

    public function isDisabled()
    {
        return $this->getState() === static::DISABLED;
    }

    public function getAllExisting(): array
    {
        return[
            static::ENABLED => 'Enabled',
            static::DISABLED => 'Disabled'
        ];
    }

}
