<?php

namespace Entities\Collection;

use RobotE13\DDD\Entities\Collection\Contact\{
    ContactsCollection
};

class CollectionTest extends CollectionAbstractTest
{

    public function getCollectionClass()
    {
        return ContactsCollection::class;
    }

}
