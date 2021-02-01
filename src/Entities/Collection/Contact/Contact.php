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

namespace RobotE13\DDD\Entities\Collection\Contact;

/**
 * Description of Contact
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
class Contact
{

    /**
     * Contact type.
     * Emali, skype, telegram e t.c.
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $value;

    public function __construct(string $type, string $value)
    {
        $this->type = strtolower($type);
        $this->value = $value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isEqualTo(self $contact)
    {
        return $this->type === $contact->getType() && $this->value === $contact->getValue();
    }

}
