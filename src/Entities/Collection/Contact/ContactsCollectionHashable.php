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

use RobotE13\DDD\Entities\Collection\Contact\Contact;
use RobotE13\DDD\Entities\Collection\AbstractHashableCollection;

/**
 * Description of HashableContactsCollection
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
class ContactsCollectionHashable extends AbstractHashableCollection
{

    const COLLECTION_ITEM_NAME = 'Contact';

    public function getItemClass(): string
    {
        return Contact::class;
    }

    /**
     *
     * @param Contact $item
     * @return string
     */
    public function resolveIndexOf($item): string
    {
        return hash('crc32', "{$item->getType()}_{$item->getValue()}");
    }

}
