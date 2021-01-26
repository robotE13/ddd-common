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
interface RepresentableAsText
{

    /**
     * Returns current entity state in a text form.
     * @return string
     */
    public function getTextValue(): string;
}
