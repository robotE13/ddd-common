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

use RobotE13\DDD\Entities\Collection\AbstractCollection;

/**
 * Description of UserContacts
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
final class ContactsCollection extends AbstractCollection
{

    public function getItemClass(): string
    {
        return Contact::class;
    }

    public static function getItemName(): string
    {
        return 'Contact';
    }

}
