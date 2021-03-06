<?php

namespace Entities\Collection;

use RobotE13\DDD\Entities\Collection\Contact\{
    Contact
//    ContactsCollection
};

abstract class CollectionAbstractTest extends \Codeception\Test\Unit
{

    use \Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \RobotE13\DDD\Entities\Collection\Collection
     * @specify
     */
    protected $collection;

    protected function _before()
    {

        $contact = new Contact('email', 'test@email.ru');
        $contact2 = new Contact('email', 'test2@email.ru');
        $collectionClass = $this->getCollectionClass();
        $this->collection = new $collectionClass([$contact, $contact2]);
    }

    abstract public function getCollectionClass();

    // tests
    final public function testCreateCollecttion()
    {

        $this->specify('Test successfull create', function() {
            expect('Коллекция содержит 2 объекта', count($this->collection))->equals(2);
        });

        $this->specify('Test working with collection as array', function() {
            foreach ($this->collection as $key => $value)
            {
                expect('При обходе коллекции как массива получим значения-объекты.', $value)->isInstanceOf(Contact::class);
                expect('При обходе возвращаются ключи скалярные значения.', $key)->scalar();
            }
            expect('Получение коллекции элементов в виде массива.', $this->collection->toArray())->array();
        });

        $this->specify('Содержимое не меняется при попытке изменить полученный наружу массив.', function() {
            $items = $this->collection->toArray();
            array_pop($items);
            expect('В коллекции осталось 2 объекта', count($this->collection))->equals(2);
        });
    }

    public function testCollectionMethods()
    {
        $this->specify('Test successfull put unique element to collection', function() {
            $contact = new Contact('email', 'test4@email.ru');
            $this->collection->add($contact);
            expect('Коллекция содержит 3 элемента', count($this->collection))->equals(3);

            $contact2 = new Contact('email_pers', 'test@email.ru'); //another type of contact with same value
            $this->collection->add($contact2);
            expect('Коллекция содержит 4 элемента', count($this->collection))->equals(4);
        });

        $this->tester->markTestIncomplete();
    }

    public function testExceptions()
    {
        $this->specify('Test fail put notunique element to collection', function() {
            $contact = new Contact('email', 'test@email.ru');
            $contactCopy = clone $contact;
            expect('Возникнет ошибка при добавлении неуникального элемента', fn() => $this->collection->add($contactCopy))
                    ->throws(\Webmozart\Assert\InvalidArgumentException::class); //now Webmozart asserts throws ownn InvalidArgument that extended PHP Platform \InvalidArgument exception
        });

        $this->specify('Remove not exists.',function(){
                expect('', fn() => $this->collection->remove(111))->throws(\Webmozart\Assert\InvalidArgumentException::class, "Contact with key `111` not present in collection.");
        });
    }

}
