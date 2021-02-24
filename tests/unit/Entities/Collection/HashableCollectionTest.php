<?php

namespace Entities\Collection;

use RobotE13\DDD\Entities\Collection\Contact\ContactsCollectionHashable;

class HashableCollectionTest extends CollectionAbstractTest
{

    public function getCollectionClass()
    {
        return ContactsCollectionHashable::class;
    }

}
